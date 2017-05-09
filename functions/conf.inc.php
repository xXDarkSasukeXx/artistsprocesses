<?php
define("DB_DRIVER", "mysql");
define("DB_NAME", "artistsprocesses");
define("DB_HOST", "localhost");
define("DB_PORT", 8889);
define("DB_USER", "root");
define("DB_PWD", "root");

$list_of_status = ["0"=>"Visiteur", "1"=>"Artiste"];
$list_of_scenes = ["0"=>"France", "1"=>"Internationale"];
$list_of_country = ["France", "Pologne", "Belgique"];
$list_of_errors = [
                    1 => "Adresse mail invalide",
                    2 => "Nom doit faire + de 2 caractères",
                    3 => "Nom et prénom identiques",
                    4 => "Le mot de passe doit faire entre 8 et 16 caractères",
                    5 => "Les mots de passe doivent être identiques",
                    6 => "Le statut doit correspondre ",
                    7 => "La date de naissance doit être valide",
                    8 => "La date de décès doit être valide",
                    9 => "La scene doit correspondre",
                    10 => "Début période de reconnaissance invalide",
                    11 => "Fin période de reconnaissance invalide",
                    12 => "CGU doit exister",
                    13 => "Le captcha entré doit correspondre",
                    14 => "L'email existe déjà"
				];
