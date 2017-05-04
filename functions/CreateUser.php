<?php
	require "../shared/header.php";
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
<div class="row">
	<div class="col-md-4">
		<?php
			require "../shared/logo.php";
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<h2>Création de compte</h2>
	  <form method="POST" action="register.php">
			<div class="col-md-12">
				<div>
					Email:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
					<input type="email" class='form-control' placeholder="Email" name="email" value="<?php echo (isset($_POST["email"]))?$_POST["email"]:"" ?>" required>
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Prénom:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
					<input type="text" class='form-control' placeholder="Name" name="name"  value="<?php echo (isset($_POST["name"]))?$_POST["name"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Nom:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
					<input type="text" class='form-control' placeholder="Surname" name="surname"  value="<?php echo (isset($_POST["surname"]))?$_POST["surname"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Mot de passe:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
					<input type="password" class='form-control' placeholder="Mot de passe" name="pwd1" required>
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Confirmez le mot de passe:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
					<input type="password" class='form-control' placeholder="Confirmation de mot de passe" name="pwd2" required>
				</div>
			</div>
			<div class="col-md-12 top-margin">
				<div>
					Status:
				</div>
				<?php
						foreach ($list_of_status as $key => $value) {
								echo "<div class='radio-inline'><label>";
								if(isset($_POST['status']) && $_POST['status']==$key){
										echo "<input type='radio' checked='checked' name='status' value='".$key."'>";
								}else{
										echo "<input type='radio' name='status' value='".$key."'>";
								}
								echo $value;
								echo "</div></label>";
						}
				?>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Année de naissance:
				</div>
				<div class="">
					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input type="date" class='' name="birthday" value="<?php echo (isset($_POST["birthday"]))?$_POST["birthday"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Année de décès:
				</div>
				<div class="">
					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input type="date" class='' name="deathday" value="<?php echo (isset($_POST["deathday"]))?$_POST["deathday"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-12 top-margin">
				<div>
					Scène:
				</div>
				<?php
						foreach ($list_of_scenes as $key => $value) {
								echo "<div class='radio-inline'><label>";
								if(isset($_POST['scene']) && $_POST['scene']==$key){
										echo "<input type='radio' checked='checked' name='scene' value='".$key."'>";
								}else{
										echo "<input type='radio' name='scene' value='".$key."'>";
								}
								echo $value;
								echo "</div></label>";
						}
				?>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Date de reconnaissance:
				</div>
				<div class="">
					<span class=""><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input type="date" class='' name="beginning" value="<?php echo (isset($_POST["beginning"]))?$_POST["beginning"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Date de la fin de reconnaissance:
				</div>
				<div class="">
					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input type="date" class='' name="ending" value="<?php echo (isset($_POST["ending"]))?$_POST["ending"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-12 top-margin">
				<img src="captcha.php" class="img-responsive">
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Veuillez saisir les chiffres indiqués:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-shield" aria-hidden="true"></i></span>
					<input type="text" class='form-control' name="captcha" required>
				</div>
			</div>
			<div class="col-md-12 top-margin">
				<input type="checkbox" name="cgu" required>J'accepte les <a href="http://lefake.fr/cgv/" target="_blank">CGU/CGV</a>
			</div>
			<div class="col-md-12 top-margin">
				<input type="submit" class='btn' value="Submit">
			</div>
	  </form>
	</div>
</div>

<?php
   /*print_r($_SESSION["captcha"]);*/
    include "../shared/footer.php";
?>
