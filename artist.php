<?php require('shared/menu.php');
      $db = connectBdd();
      // Fetch artist details
      $query = $db->prepare("SELECT * FROM users WHERE id = :id");
      $query->execute(['id'=>$_GET['id']]);
      $result = $query->fetch();
      // Fetch motor
      $get_motor = $db->prepare("SELECT * FROM users, motor WHERE users.id_MOTOR=motor.id AND users.id=:id");
      $get_motor->execute(['id'=>$_GET['id']]);
      $output = $get_motor->fetch();
      // Fetch means
      $get_means = $db->prepare("SELECT * FROM users, means WHERE users.id_MEANS=means.id AND users.id=:id");
      $get_means->execute(['id'=>$_GET['id']]);
      $output_means = $get_means->fetch();

?>
<div class="row artist_info">
  <div class="col-md-7">
    <div class="row left_side_content">
      <div class="col-md-6 artist_top artist_name">
        <?php echo $result["name"] . ' ' . $result["surname"]; ?>
      </div>
      <div class="col-md-6 artist_top">
        <?php
          echo date('Y',strtotime($result["best_period_beginning"])) . '-' . date('Y',strtotime($result["best_period_ending"]));
        ?>
      </div>
      <div class="col-md-12 top-margin">
        <span class="color_red">MOTEUR</span>
        <span class="title_suffix">
          <span class="color_red main_font">a</span><span class="color_brown main_font">p</span>
        </span>
      </div>
      <div class="col-md-12 artist_label">
        <?php echo $output["label"]; ?>
      </div>
      <div class="col-md-12">
        <?php echo $output["description"]; ?>
      </div>
    </div>
    <div class="row left_side_content">
      <div class="col-md-12 top-margin">
        <span class="color_red">MOYEN</span>
        <span class="title_suffix">
          <span class="color_red main_font">a</span><span class="color_brown main_font">p</span>
        </span>
      </div>
      <div class="col-md-12 artist_label">
        <?php echo $output_means["label"]; ?>
      </div>
      <div class="col-md-12">
        <?php echo $output_means["description"]; ?>
      </div>
    </div>
  </div>
  <div class="col-md-5 nopad">
    <div class="col-md-12 related_artists">
      <div class="col-md-5 artist_scene">
        <span class="color_red">Artistes</span> de la scène:
        <div>
          Ayant le même
        </div>
      </div>
      <div class="col-md-7 checks">
        <div>
          <span class="checkboxes">
            <div class="col-md-6">
              <input type="checkbox" name="scene" value="International"> Internationale
            </div>
            <div class="col-md-6">
              <input type="checkbox" name="scene" value="French"> Française
            </div>
          </span>
        </div>
        <div>
          <span class="checkboxes">
            <div class="col-md-6">
              <input type="checkbox" name="mandm" value="Moteur"> Moteur
            </div>
            <div class="col-md-6">
              <input type="checkbox" name="mandm" value="Moyen"> Moyen
            </div>
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-12 text-center top-margin">
      Related artists, Related artists, Related artists, Related artists, Related artists,
    </div>
  </div>
</div>
<div class="row artist-arts">
  <div class="col-md-12">
    <i class="fa fa-angle-left color_brown" aria-hidden="true"></i>
    <i class="fa fa-angle-right color_brown" aria-hidden="true"></i>
    <div class="slider">
      <div class="">
        image 1
      </div>
      <div class="">
        image 2
      </div>
      <div class="">
        image 3
      </div>
      <div class="">
        image 4
      </div>
    </div>

  </div>
</div>
<?php require('shared/footer.php'); ?>
