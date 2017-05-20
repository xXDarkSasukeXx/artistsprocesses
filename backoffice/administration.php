<?php
session_start();
require "../functions/init.php";


$bdd = connectBdd();


if(
    !empty($_POST["name"]) &&
    !empty($_POST["surname"]) &&
    !empty($_POST["birthday"]) &&
    !empty($_POST["scene"]) &&
    (!empty($_POST["captcha"]) || !empty($_GET["id"]))
  ){
    $error = FALSE;
    $msgErrors;

    $_POST['name'] = trim($_POST['name']);
    $_POST['surname'] = trim($_POST['surname']);

    //Vérifier format de l'adresse email

    // Vérifier nom 2 caractères mini
    if(strlen($_POST['name']) < 2){
        $error = TRUE;
        $msgErrors[]=2;
    }

    if($_POST["name"] == $_POST["surname"]){
        $error = TRUE;
        $msgErrors[]=3;
    }


    //la date de naissance doit être valide
    $explodeDate = explode("-", $_POST["birthday"]);
    if(count($explodeDate)!=3 || !checkdate($explodeDate[1], $explodeDate[2], $explodeDate[0])  ){
  		$error = true;
  		$msgErrors[]=7;
  	}else{

  		$ilYA120ans = time() - (31536000*120);
  		$ilYA10ans = time() - (31536000*10);
  		if( strtotime($_POST["birthday"])<$ilYA120ans ||
  			strtotime($_POST["birthday"])>$ilYA10ans) {
  			$error = true;
  			$msgErrors[]=7;
  		}
  	}



    if (!empty($_POST["deathday"])) {
      //la date de décès doit être valide
      $deathday = explode("-", $_POST["deathday"]);
      if(count($deathday)!=3 || !checkdate($deathday[1], $deathday[2], $deathday[0])  )
      {
          $error = TRUE;
          $msgErrors[]=8;
      }else{
          if(strtotime($_POST["deathday"]) < strtotime($_POST["birthday"]) && strtotime($_POST["deathday"])!=0){
              $error = TRUE;
              $msgErrors[]=8;
          }
      }
    }else {
      $_POST["deathday"] == 0000-00-00;
    }


    // Début période de reconnaissance invalide
    if (!empty($_POST["deathday"])) {
      //la date de décès doit être valide
      $deathday = explode("-", $_POST["deathday"]);
      if(count($deathday)!=3 || !checkdate($deathday[1], $deathday[2], $deathday[0])  )
      {
          $error = TRUE;
          $msgErrors[]=8;
      }else{
          if(strtotime($_POST["deathday"]) < strtotime($_POST["birthday"]) && strtotime($_POST["deathday"])!=0){
              $error = TRUE;
              $msgErrors[]=8;
          }
      }
    }else {
      $_POST["deathday"] == 0000-00-00;
    }


    // Début période de reconnaissance invalide
    if (!empty($_POST["beginning"])) {
      $beginning = explode("-", $_POST["beginning"]);
      if(count($beginning)!=3 || !checkdate($beginning[1], $beginning[2], $beginning[0])  )
      {
          $error = TRUE;
          $msgErrors[]=10;
      }else{
          if(strtotime($_POST["beginning"]) < strtotime($_POST["birthday"])){
              $error = TRUE;
              $msgErrors[]=10;
          }
      }
    }else {
      $_POST["beginning"] == 0000-00-00;
    }

    // Fin période de reconnaissance invalide
    if (!empty($_POST["ending"])) {
      $ending = explode("-", $_POST["ending"]);
      if(count($ending)!=3 || !checkdate($ending[1], $ending[2], $ending[0])  )
      {
          $error = TRUE;
          $msgErrors[]=11;
      }else{
          if(strtotime($_POST["ending"]) < strtotime($_POST["beginning"])){
              $error = TRUE;
              $msgErrors[]=11;
          }
      }
    }else {
      $_POST["ending"] == 0000-00-00;
    }


    if(!isset($_GET["id"])){

        //CGU doit exister
        if(!isset($_POST["cgu"])){
            $error = TRUE;
            $msgErrors[]=12;
        }

        //le captcha entré doit correspondre
        if($_POST["captcha"] != $_SESSION['captcha']){
            $error = TRUE;
            $msgErrors[]=13;
        }
    }


    if(!$error){
        if(empty($_GET["id"])){
                $query = $bdd->prepare(
                    "INSERT INTO users (name, surname, birthday, date_death, scene, best_period_beginning, best_period_ending)
                    VALUES (:name,:surname,:birthday,:deathday, :scene, :beginning, :ending);"
                    );
                $query->execute([
                    "name"=>$_POST["name"],
                    "surname"=>$_POST["surname"],
                    "birthday"=>$_POST["birthday"],
                    "deathday"=>$_POST["deathday"],
                    "scene"=>$_POST["scene"],
                    "beginning"=>$_POST["beginning"],
                    "ending"=>$_POST["ending"],
                ]);
        }else{
            $query = $bdd->prepare(
                "UPDATE users SET
                name=:name,
                surname=:surname,
                birthday=:birthday,
                date_death=:deathday,
                scene=:scene,
                best_period_beginning=:beginning,
                best_period_ending=:ending,
                date_updated=now()
                WHERE id=:id"
            );

            $query->execute([
                "name"=>$_POST["name"],
                "surname"=>$_POST["surname"],
                "birthday"=>$_POST["birthday"],
                "deathday"=>$_POST["deathday"],
                "scene"=>$_POST["scene"],
                "beginning"=>$_POST["beginning"],
                "ending"=>$_POST["ending"],
                "id"=>$_GET["id"]
            ]);

        }
        header("Location: admin_create_artist.php");

    }else{
      $_SESSION['subscription'] = implode(',', $msgErrors);
      $_SESSION['data_form'] = $_POST;
      if (empty($_GET["id"])) {
        header("Location: admin_create_artist.php");
      }else{
        header("Location: ../functions/modifyUser.php?id=".$_GET["id"]);
      }
    }
  }


?>
