<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Artists Processes</title>
    <link href="../inc/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../inc/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../inc/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="../inc/slick/slick-theme.css"/>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <?php
    require('../functions/init.php');
    $db = connectBdd();
    // Fetch artist details
    $query = $db->prepare("SELECT * FROM users WHERE id = :id");
    $query->execute(['id'=>$_GET['id']]);
    $result = $query->fetch();
    // if (!isConnected()) {
    //   echo "<script>location.href='../public/index.php';</script>";
    // }
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="sidebar">
          <div class="sidebarHeader">
            <div class="toggle_button">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="userName">
              <?php echo $result['name']. ' ' . $result['surname']; ?>
            </div>
            <div class="userStatus">
              <?php
                switch ($result['status']) {
                  case 0:
                    echo 'Utilisateur';
                    break;
                  case 1:
                    echo "Artiste";
                    break;
                  case 2:
                    echo "Administrateur";
                    break;
                  default:
                    echo 'Utilisateur';
                    break;
                }
              ?>
            </div>
          </div>
          <div class="sidebarBody">
            <ul class="" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Profil</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Messages</a></li>
              <?php
              if ($result['status']==2) {
                echo '<li role="presentation"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Gestion</a></li>
                      <li role="presentation"><a href="#artists" aria-controls="artists" role="tab" data-toggle="tab">Les artistes</a></li>
                      <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Les utilisateurs</a></li>';
              }
              ?>
              <li role="presentation"><a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">Les abonnés</a></li>
              <li role="presentation"><a href="#following" aria-controls="following" role="tab" data-toggle="tab">Vos abonnements</a></li>
              <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact</a></li>
            </ul>
        </div>
        <div class="mainBackoffice">
          <?php require('tabs.php'); ?>
        </div>
      </div>
    </div>

<?php require("../shared/footer.php") ?>
