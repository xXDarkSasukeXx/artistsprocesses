<?php require('../shared/header.php');
      require("../functions/init.php");
?>
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
  <div class="col-md-4 col-md-offset-4 artist_list">
    <?php
      $db = connectBdd();
    	$result = $db->query("SELECT * FROM users WHERE is_deleted IS NULL AND is_verified=1 AND status=1");
      while ($resultat = $result->fetch())
  		{
  			echo '<a href="artist.php?id='.$resultat["id"].'&name='.$resultat["name"].$resultat["surname"].'">' . $resultat["name"] . ' ' . $resultat["surname"] .'</a> / ';
  		}
    ?>
  </div>
</div>

<?php require('../shared/footer.php'); ?>
