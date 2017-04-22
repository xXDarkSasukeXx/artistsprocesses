<?php require('header.php') ?>
<div class="container content">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="col-md-12" id="logo_box">
        <div class="logo_letter_box">
          1
        </div>
        <div class="logo_letter_box">
          0
        </div>
        <div class="logo_letter_box">
          8
        </div>
        <div class="logo_letter_box">
          9
        </div>
      </div>
      <div class="col-md-12 logo_second_part">
        <span class='color_red'>artist'</span><span class="color_brown"> processes</span>
      </div>
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
<?php require('footer.php') ?>
