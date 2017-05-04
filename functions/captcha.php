<?php
session_start();
header("Content-type:image/png");

$longueur_du_captcha = rand(4,6);
$caractere_possibles = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

$caractere_possibles = str_shuffle($caractere_possibles); //Mélange des lettres
$captcha = substr($caractere_possibles, 0, $longueur_du_captcha);
$formes = rand(0,5);

$_SESSION['captcha'] = $captcha;

$image = imagecreate(100,50);
$tableau["color"][0]=imagecolorallocate($image, 88, 41, 0);//marron
$tableau["color"][1] =imagecolorallocate($image, 255, 0, 0);//rouge
$tableau["color"][2]=imagecolorallocate($image, 0, 0, 0);//noir
$tableau["color"][3]=imagecolorallocate($image, 255, 69, 0);//orange
$tableau["color"][4]=imagecolorallocate($image, 102, 0, 153);//violet
$tableau["colortext"][5]=imagecolorallocate($image, 0, 0, 255);//bleu
$tableau["colortext"][6]=imagecolorallocate($image, 255, 215, 0);//jaune
$tableau["colortext"][7]=imagecolorallocate($image, 0, 255, 0);//vert
$tableau["colortext"][8]=imagecolorallocate($image, 139, 131, 129);//gris
$tableau["colortext"][9]=imagecolorallocate($image, 255, 255, 255);//blanc

$back_color = $tableau["color"][rand(0,4)];
$color_text = $tableau["colortext"][rand(5,9)];

for ($i=0; $i < $formes; $i++) {
	$aleatoire = rand(0,2);
	$alea = $aleatoire;
	$x1 = rand(0,100);
	$y1 = rand(0,100);
	$x2 = rand(0,100);
	$y2 = rand(0,100);

	switch ($aleatoire == $alea) {
		case $alea = 0:
			imageline($image, $x1, $y1, $x2, $y2, $color_text);
			break;

		case $alea = 1:
			imageellipse($image, $x1, $y1, $x2, $y2, $color_text);
			break;

		case $alea = 2:
			imagerectangle($image, $x1, $y1, $x2, $y2, $color_text);
			break;
	}
}
//imagettftext($image, 20, 0, rand(10,20), rand(20,30), $color_text,"fonts/DIRTYEGO.TTF" , $captcha);
imagefill($image, 0, 0, $back_color);
imagestring($image, 5, 25, 20, $captcha, $color_text);

//$formes = str_shuffle($formes);
//imagettftext($image, rand(0,99), rand(60,100), rand(10,40), rand(10,40), $tableau["colortext"][rand(5,9)], "fonts/master_of_break.ttf", $formes);
//$formes = str_shuffle($formes);
//imagettftext($image, rand(0,99), rand(60,100), rand(10,40), rand(10,40), $tableau["colortext"][rand(5,9)], "fonts/Raisin des Sables.ttf", $formes);
//$formes = str_shuffle($formes);
//imagettftext($image, rand(0,99), rand(60,100), rand(10,40), rand(10,40), $tableau["colortext"][rand(5,9)], "fonts/Raisin des Sables.ttf", $formes);

imagepng($image); //en cas d'erreur, mettre header et imagepng en commentaire pour la faire ressortir sur le message d'erreur.
//BOUTON ACTUALISER
?>
