<?php require('../shared/header.php') ?>
<div class="container content">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <?php include('../shared/logo.php') ?>
    </div>
    <div class="col-md-offset-10">
      Connexion
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4 input-group search-bar">
      <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
      <input type="text" class='form-control input_search' name="artistSearch" placeholder="Entrez un nom d'artiste">
      <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <?php
      function connectBdd(){
      	try{
          $bdd = new PDO("mysql:host=localhost;dbname=artistsprocesses;port=8889", "root", "root");
      	}catch(Exception $e){
      		die("Erreur : ".$e->getMessage()); // ="méthode"
      	}
          return $bdd;
      }
        $db = connectBdd();
        $getusers = $db->prepare("SELECT name, surname FROM USERS");
        $results = $getusers->fetch();
        echo $results;
      ?>
    </div>
  </div>

</div>
<?php require('../shared/footer.php') ?>
