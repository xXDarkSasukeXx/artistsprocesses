<?php require "../functions/init.php" ?>
<!DOCTYPE HTML>
<html>
    <head>
		<title>Draw | AP</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/paint.css" type="text/css">
    </head>
    <body>
		<h1>Salle #</h1>

    <canvas id="canvas" width="800" height="800"></canvas>

		<ul id="couleurs">
			<li><a href="#" data-couleur="#000000" class="actif">Noir</a></li>
			<li><a href="#" data-couleur="#ffffff">Blanc</a></li>
			<li><a href="#" data-couleur="#ff0000">Rouge</a></li>
			<li><a href="#" data-couleur="brown">Marron</a></li>
			<li><a href="#" data-couleur="orange">Orange</a></li>
			<li><a href="#" data-couleur="yellow">Jaune</a></li>
			<li><a href="#" data-couleur="green">Vert</a></li>
			<li><a href="#" data-couleur="cyan">Cyan</a></li>
			<li><a href="#" data-couleur="blue">Bleu</a></li>
			<li><a href="#" data-couleur="indigo">Indigo</a></li>
			<li><a href="#" data-couleur="Violet">Violet</a></li>
			<li><a href="#" data-couleur="pink">Rose</a></li>
		</ul>

		<form id="largeurs_pinceau">
			<label for="largeur_pinceau">Largeur du pinceau :</label>
			<input id="largeur_pinceau" type="range" min="2" max="50" value="5">
			<output id="output">5 pixels</output>

			<br>

			<input type="reset" id="reset" value="Réinitialiser">
			<input type="button" id="save" value="Sauvergarder mon image">
		</form>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/paint.js"></script>
    </body>
</html>
