<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Artists Processes | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../inc/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
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
      echo "<script>location.href='../public/index.php';</script>";
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
              ><a href="#profil" aria-controls="profil" role="tab" data-toggle="tab">Profil</a></li>
              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
              <?php
              if ($result['is_admin']==1) {
                echo '<li role="presentation" class="active"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Gestion</a></li>
                      <li role="presentation"><a href="#artists" aria-controls="artists" role="tab" data-toggle="tab">Les artistes</a></li>
                      <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Les utilisateurs</a></li>';
              }
              ?>
              <li role="presentation"><a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">Les abonnés</a></li>
              <li role="presentation"><a href="#following" aria-controls="following" role="tab" data-toggle="tab">Vos abonnements</a></li>
              <li role="presentation"><a href="#contact" aria-controls="contact" role="tab" data-toggle="tab">Contact</a></li>
            </ul>
        </div>
      </div>
      <div class="mainBackoffice">
        <?php require('tabs.php'); ?>
      </div>
    </div>

<?php require('footer_back.php'); ?>
