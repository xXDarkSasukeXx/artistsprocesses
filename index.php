<?php
session_start();
require("functions/init.php");
require('shared/header.php');
?>
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <?php include('shared/logo.php') ?>
  </div>
  <div class="col-md-offset-10 top-connection">
    <?php if(!isConnected()): ?>
        <a href="#" class="color_red" data-toggle="modal" data-target=".connectUser"><i class="fa fa-user-o" aria-hidden="true"></i> Se connecter</a>
    <?php else:?>
      <?php
        $db = connectBdd();
        $connectedUser = $db->query("SELECT * FROM users WHERE is_deleted is null AND accesstoken is not null");
        $connected = $connectedUser->fetch();
      ?>
      <?php echo '<a href="backoffice/index.php?id='.$connected['id'].'" class="connected_user"><i class="fa fa-user-o" aria-hidden="true"></i> '; ?>
        <?php echo $connected['name'] . ' ' . $connected['surname']; ?>
      </a>
      <a href="functions/disconnectUser.php" class="color_red">Se déconnecter</a>
    <?php endif; ?>
  </div>

  <?php require("shared/connectionModal.php"); ?>

</div>
<div class="row">
  <div class="col-md-4 col-md-offset-4 input-group search-bar">
    <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
    <input type="text" onkeyup="showHint(this.value)" class='form-control input_search' name="artistSearch" placeholder="Entrez un nom d'artiste">
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

<?php require('shared/footer.php'); ?>
