<?php

require "../functions/init.php";

$bdd = connectBdd();
$query = $bdd->prepare("UPDATE users SET is_verified=1 WHERE id=:id");
$query->execute($_GET);

header("Location: index.php?id=1");
