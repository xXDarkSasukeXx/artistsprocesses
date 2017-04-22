<?php 
	require "init.php";

 
if(isset( $_SESSION['subscription']) ){
    $_POST = $_SESSION['subscription'];
    echo "<ul>";
    foreach ($_SESSION['error_subscription'] as $error) {
        echo "<li>".$list_of_errors[$error];
    }
    echo "</ul>";
    session_destroy();
}
 
?>

<section>
    <center>
        <h2>CREATION USER</h2>
        <form method="POST" action="register.php">

        <input type="email" placeholder="Email" name="email" value="<?php echo (isset($_POST["email"]))?$_POST["email"]:"" ?>" required><br><br>
            
        <input type="text" placeholder="Name" name="name"  value="<?php echo (isset($_POST["name"]))?$_POST["name"]:"" ?>" ><br><br>

        <input type="text" placeholder="Surname" name="surname"  value="<?php echo (isset($_POST["surname"]))?$_POST["surname"]:"" ?>" ><br><br>

        <input type="password" placeholder="Password" name="pwd1" required><br><br>

        <input type="password" placeholder="Confirm" name="pwd2" required><br><br>

        <?php
            foreach ($list_of_status as $key => $value) {
                echo "<label>";
                if(isset($_POST['status']) && $_POST['status']==$key){
                    echo "<input type='radio' checked='checked' name='status' value='".$key."'>";
                }else{
                    echo "<input type='radio' name='status' value='".$key."'>"; 
                }
                echo $value;
                echo "</label>";
            }
        ?><br><br>

        <input type="date" name="birthday" value="<?php echo (isset($_POST["birthday"]))?$_POST["birthday"]:"" ?>" ><br><br>

        <input type="date" name="deathday" value="<?php echo (isset($_POST["deathday"]))?$_POST["deathday"]:"" ?>" ><br><br>

        <?php
            foreach ($list_of_scenes as $key => $value) {
                echo "<label>";
                if(isset($_POST['scene']) && $_POST['scene']==$key){
                    echo "<input type='radio' checked='checked' name='scene' value='".$key."'>";
                }else{
                    echo "<input type='radio' name='scene' value='".$key."'>"; 
                }
                echo $value;
                echo "</label>";
            }
        ?><br><br>
            
        <input type="date" name="beginning" value="<?php echo (isset($_POST["beginning"]))?$_POST["beginning"]:"" ?>" ><br><br>

        <input type="date" name="ending" value="<?php echo (isset($_POST["ending"]))?$_POST["ending"]:"" ?>" ><br><br>
            
        <img src="captcha.php">
        <input type="text" name="captcha" required><br><br>      
            
        <textarea name="comment"><?php echo (isset($_POST["comment"]))?$_POST["comment"]:"" ?></textarea><br><br>
        
        <input type="checkbox" name="cgu" required>J'accepte les <a href="http://lefake.fr/cgv/" target="_blank">CGU/CGV</a><br><br>
            
        <input type="submit" value="Submit">

        </form>
    </center>
</section>

<?php 
   /*print_r($_SESSION["captcha"]);*/
    include "footer.php";
?>