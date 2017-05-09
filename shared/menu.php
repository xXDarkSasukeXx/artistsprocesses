<?php
session_start();
require('../functions/init.php');
require('header.php'); ?>
  <div class="container content">
    <div class="row">
      <div class="col-md-3">
        <?php include('logo.php') ?>
      </div>
      <div class="col-md-6">
        <ul class="menu-parent">
          <li class='menu_li'><a href="../public/about.php" class="color_brown">À propos</a></li>
          <li class='menu_li'><a href="../public/process.php" class="color_brown">Le processus artistique</a></li>
          <li class='menu_li'><a href="../public/base.php" class="color_brown">Les artistes de la base</a></li>
          <li class='menu_li'><a href="../public/author.php" class="color_brown">L'auteur</a></li>
          <li class='menu_li'><a href="../public/contact.php" class="color_brown">Contact</a></li>
        </ul>
        <div class="row">
          <div class="col-md-9">
            <div class="input-group search-bar">
              <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
              <input type="text" class='form-control input_search' name="artistSearch" placeholder="Entrez un nom d'artiste">
              <span class="input-group-addon"><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-md-offset-1 top-connection">
        <?php if(!isConnected()): ?>
            <a href="#" class="color_red" data-toggle="modal" data-target=".connectUser"><i class="fa fa-user-o" aria-hidden="true"></i> Se connecter</a>
				<?php else:?>
          <?php
            $db = connectBdd();
            $connectedUser = $db->query("SELECT * FROM users WHERE is_deleted is null AND accesstoken is not null");
            $connected = $connectedUser->fetch();
          ?>
          <?php echo '<a href="../backoffice/index.php?id='.$connected['id'].'" class="connected_user"><i class="fa fa-user-o" aria-hidden="true"></i> '; ?>
            <?php echo $connected['name'] . ' ' . $connected['surname']; ?>
          </a>
					<a href="../functions/disconnectUser.php" class="color_red">Se déconnecter</a>
				<?php endif; ?>
      </div>

      <?php require("connectionModal.php"); ?>
    </div>
