<?php
	session_start();
	require "lib.php";
	
	if (
		isset($_POST["label"]) &&
		isset($_POST["description"])
		) {
		if (strlen($_POST["label"] > 50)) {
			
			echo "Le label ne peut pas contenir plus de 50 caractères";

		} else {

			$db=dbConnect();
	
			$query=$db->prepare("INSERT INTO MOTOR (label,description) VALUES(:label,:description);");

			$query->execute([
			"label"=>$_POST["label"],
			"description"=>$_POST["description"]
			]);
		}	
	}



?>

<form method="POST" action="">
	<input type="text" name="label">
	<br>
	<input type="text" name="description">
	<br>
	<input type="submit" value="Confirm">
</form>