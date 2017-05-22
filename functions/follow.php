<?php
  session_start();
  require "init.php";

  $db = connectBdd();
  $query=$db->prepare("SELECT id FROM users WHERE email = :email");
  $query->execute([
    'email'=>$_SESSION['email']
  ]);
  $result=$query->fetch();
  print_r($result);

  $query=$db->prepare("INSERT INTO follow (id,follows) VALUES(:id, :follows)");
  $query->execute([
    "id"=>$result["id"],
    "follows"=>$_GET["id"]
  ]);

 ?>
