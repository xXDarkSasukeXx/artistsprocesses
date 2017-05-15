<?php
	session_start();
	require "../shared/header.php";
	require "../functions/init.php";


if(isset( $_SESSION['subscription']) ){
    $msgErrors = explode(",", $_SESSION['subscription']);
    foreach ($msgErrors as $error) {
        echo "<li>".$list_of_errors[$error];
    }

		$form = $_SESSION['data_form'];
		unset($_SESSION['data_form']);
		unset($_SESSION['subscription']);
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
		<h2>Création d'un Artiste</h2>
	  <form method="POST" action="administration.php">
			<div class="col-md-6 top-margin">
				<div>
					Prénom:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
					<input type="text" class='form-control' placeholder="Name" name="name"  value="<?php echo (isset($form["name"]))?$form["name"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Nom:
				</div>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
					<input type="text" class='form-control' placeholder="Surname" name="surname"  value="<?php echo (isset($form["surname"]))?$form["surname"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Année de naissance:
				</div>
				<div class="">
					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input type="date" class='' name="birthday" value="<?php echo (isset($form["birthday"]))?$form["birthday"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Année de décès:
				</div>
				<div class="">
					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input type="date" class='' name="deathday" value="<?php echo (isset($form["deathday"]))?$form["deathday"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-12 top-margin">
				<div>
					Scène:
				</div>
				<?php
						foreach ($list_of_scenes as $key => $value) {
								echo "<div class='radio-inline'><label>";
								if(isset($form['scene']) && $form['scene']==$key){
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
					<input type="date" class='' name="beginning" value="<?php echo (isset($form["beginning"]))?$form["beginning"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-6 top-margin">
				<div>
					Date de la fin de reconnaissance:
				</div>
				<div class="">
					<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					<input type="date" class='' name="ending" value="<?php echo (isset($form["ending"]))?$form["ending"]:"" ?>" >
				</div>
			</div>
			<div class="col-md-12 top-margin">
				<img src="../functions/captcha.php" class="img-responsive">
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
