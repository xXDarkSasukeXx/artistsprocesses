<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Artists Processes | Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
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
    $_SESSION['id']=$result['id'];
    if (!isConnected() || $_SESSION['id']!=$_GET['id']) {
      echo "<script>location.href='../index.php';</script>";
    }
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="sidebar-ap">
          <div class="sidebarHeader">
            <div class="toggle_button">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="userName">
              <?php echo $result['name']. ' ' . $result['surname']; ?>
            </div>
            <div class="userStatus">
              <?php
                if($result['is_admin']==1){
                  echo 'Administrateur';
                }else{
                  if ($result['status']==1) {
                    echo 'Artiste';
                  }else{
                    echo 'Utilisateur';
                  }
                }
              ?>
            </div>
          </div>
          <div class="sidebarBody">
            <ul class="" role="tablist">
              <li role="presentation"
              <?php if($result['is_admin']==0){
                if ($result['status']==1 || $result['status']) {
                  echo 'class="active"';
                }
              } ?>
              >
                <a href="#profil" aria-controls="profil" role="tab" data-toggle="tab">
                  <i class="fa fa-user sidebar_icons" aria-hidden="true"></i>Profil
                </a>
              </li>
              <li role="presentation">
                <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
                  <i class="fa fa-comments sidebar_icons" aria-hidden="true"></i>Messages
                </a>
              </li>
              <?php
              if ($result['is_admin']==1) {
                echo '<li role="presentation" class="active"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab"><i class="fa fa-tasks sidebar_icons" aria-hidden="true"></i>Gestion</a></li>
                      <li role="presentation"><a href="#artists" aria-controls="artists" role="tab" data-toggle="tab"><i class="fa fa-paint-brush sidebar_icons" aria-hidden="true"></i>Les artistes</a></li>
                      <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab"><i class="fa fa-users sidebar_icons" aria-hidden="true"></i>Les utilisateurs</a></li>';
              }
              ?>
              <li role="presentation">
                <a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">
                  <i class="fa fa-arrow-circle-right sidebar_icons" aria-hidden="true"></i>Les abonnés
                </a>
              </li>
              <li role="presentation">
                <a href="#following" aria-controls="following" role="tab" data-toggle="tab">
                  <i class="fa fa-arrow-circle-left sidebar_icons" aria-hidden="true"></i>Vos abonnements
                </a>
              </li>
              <li role="presentation">
                <a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">
                  <i class="fa fa-envelope sidebar_icons" aria-hidden="true"></i>Contact
                </a>
              </li>
            </ul>
        </div>
      </div>
      <div class="mainBackoffice">
        <?php require('tabs.php'); ?>
      </div>
    </div>

<?php require('footer_back.php'); ?>
