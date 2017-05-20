<?php
session_start();
require('../functions/init.php');
  $db = connectBdd();
  $query = $db->prepare("SELECT * FROM users WHERE id = :id");
  $query->execute(['id'=>$_GET['id']]);
  $result = $query->fetch();
  if (!isConnected()) {
    echo "<script>location.href='../public/index.php';</script>";
  }

  if( !file_exists("../gallery")){
    mkdir("../gallery");
  }else {
    if (!file_exists("../gallery/" . $result['id'] ."")) {
      mkdir("../gallery/". $result['id'] . "");
    }
  }
  $target_dir = "../gallery/". $result['id'] . "/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "Votre fichier est - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "L'image que vous essayez de télécharger n'est pas une image.";
          $uploadOk = 0;
      }

  }
  if (file_exists($target_file)) {
    echo "Ce fichier existe déjà.";
    $uploadOk = 0;
  }
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Votre fichier est trop large.";
    $uploadOk = 0;
  }
  if($imageFileType != "jpg" && $imageFileType != "png" &&
    $imageFileType != "jpeg"  && $imageFileType != "gif" ) {
      echo "Votre fichier doit être un jpg, png, jpeg ou gif.";
      $uploadOk = 0;
  }
  if ($uploadOk == 0) {
      echo "Désolé, votre fichier n'a pas pu etre télécharger.";
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Votre fichier ". basename( $_FILES["fileToUpload"]["name"]). " a été téléchargé.";
        $query = $db->prepare(
            "INSERT INTO pictures (picture, id)
            VALUES (:picture, :id);"
            );
        $query->execute([
            "picture"=>$target_file,
            "id"=>$_GET["id"],
        ]);
      }else{
          echo "Erreur fichier.";
      }
  }
