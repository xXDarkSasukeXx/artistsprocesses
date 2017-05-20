<?php

/*date_default_timezone_set('Etc/UTC');
 
require 'phpmailer/PHPMailerAutoload.php';*/
    require "../functions/init.php";

  $db = ConnectBdd();
  $query = $db->prepare("SELECT email,name,surname,password,status,birthday,date_death,scene,best_period_beginning,best_period_ending FROM users WHERE id=:id");
  $query->execute($_GET);
  $result = $query->fetch();

  if(!empty($result)){
    $form = $result;
  }

if(isset( $_SESSION['error_subscription']) ){
    $list_of_errors = explode(",", $_SESSION['error_subscription']);
    echo "<ul>";
    foreach ($_SESSION['error_subscription'] as $error) {
        echo "<li>".$list_of_errors[$error];
    }
    echo "</ul>";
    $form = $_SESSION['subscription'];

    unset($_SESSION['subscription']);
    unset($_SESSION['error_subscription']);
}

?>

    <form method="POST" action="../functions/register.php?id=<?php echo (isset($_GET["id"]))?$_GET["id"]:""; ?>">

        
      <input type="email" placeholder="Email" name="email" value="<?php echo (isset($form["email"]))?$form["email"]:"" ?>" required><br><br>
          
      <input type="text" placeholder="Name" name="name"  value="<?php echo (isset($form["name"]))?$form["name"]:"" ?>" ><br><br>

      <input type="text" placeholder="Surname" name="surname"  value="<?php echo (isset($form["surname"]))?$form["surname"]:"" ?>" ><br><br>

      <input type="password" placeholder="Password" name="pwd1" required><br><br>

      <input type="password" placeholder="Confirm" name="pwd2" required><br><br>

      <?php
      foreach ($list_of_status as $key => $value) {
        echo "<label>";
        if(isset($form['status']) && $form['status']==$key){
          echo "<input type='radio' checked='checked' name='status' value='".$key."'>";
        }else{
          echo "<input type='radio' name='status' value='".$key."'>"; 
        }
        echo $value;
        echo "</label>";
      }
      ?><br><br>

      <input type="date" name="birthday" value="<?php echo (isset($form["birthday"]))?$form["birthday"]:"" ?>" ><br><br>

      <input type="date" name="deathday" value="<?php echo (isset($form["deathday"]))?$form["deathday"]:"" ?>" ><br><br>

      <?php
      foreach ($list_of_scenes as $key => $value) {
        echo "<label>";
        if(isset($form['scene']) && $form['scene']==$key){
        echo "<input type='radio' checked='checked' name='scene' value='".$key."'>";
        }else{
          echo "<input type='radio' name='scene' value='".$key."'>"; 
        }
        echo $value;
        echo "</label>";
      }
      ?><br><br>
                
      <input type="date" name="beginning" value="<?php echo (isset($form["beginning"]))?$form["beginning"]:"" ?>" ><br><br>

      <input type="date" name="ending" value="<?php echo (isset($form["ending"]))?$form["ending"]:"" ?>" ><br><br>
                
      <input type="submit" value="Submit">


    </form>

</section>