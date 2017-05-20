<?php
session_start();
require('init.php');
if(!empty($_POST['pwd1']) && !empty($_POST['email'])){
  $db = connectBdd();
  $verify = $db->prepare("SELECT password, id FROM users WHERE is_deleted is null AND email = :email");
  $verify->execute(['email'=>$_POST['email']]);
  $result = $verify->fetch();
  if( !empty($result) && password_verify($_POST['pwd1'], $result['password'])){
    //Création d'une chaine aléatoire
    $accessToken = md5(uniqid().substr("jojojjooefozfiiefoiizfeon12312", 0, rand(5,10)).time());
    //On le stock en session avec l'email
    $_SESSION["accesstoken"]=$accessToken;
    $_SESSION['email']=$_POST['email'];
    //On l'insère en BDD dans une nouvelle colonne 'access_token'
    $insertion = $db->prepare("UPDATE users SET accesstoken = :access_token WHERE id= :id");
    $insertion->execute(['access_token'=>$accessToken, "id"=>$result['id']]);

    header("Location: ../public/index.php");
  }else{
    $msg_error = 'Identifiants incorrects';
    if( !file_exists("log")){
      mkdir("log");
      $file = fopen("log/logging.txt", "a");
      fwrite($file, $_POST['email'].':'.$_POST['pwd1']."\r\n");
      fclose($file);
    }else{
      $file = fopen("log/logging.txt", "a");
      fwrite($file, $_POST['email'].':'.$_POST['pwd1']."\r\n");
      fclose($file);
    }
  }
}
?>
