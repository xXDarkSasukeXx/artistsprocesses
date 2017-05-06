<?php
require "init.php";
if (!empty($_POST["label"]) && !empty($_POST["description"])){

  $bdd = connectBdd();
  $query = $bdd -> prepare("SELECT label, description FROM motor WHERE label= :label AND description=:description");
  $query -> execute([

          "label"=>$_POST["label"],
          "description"=>$_POST["description"]

      ]);
  $result = $query->fetch();

  // Email existant en base ?
  if(!empty($result)){
    header("Location: motorForm.php");
  }else {
    if (strlen($_POST["label"] > 10)) {

      echo "Le label ne peut pas contenir moins de 10 caractères";

    } else {

      $db=connectBdd();

      $query=$db->prepare("INSERT INTO motor (label,description) VALUES(:label,:description);");

      $query->execute([
      "label"=>$_POST["label"],
      "description"=>$_POST["description"]
      ]);
    }
  }
}

?>
