<?php
require('init.php');
$db = connectBdd();
$result = $db->query("SELECT name, surname FROM users WHERE is_deleted is null");
while ($resultat = $result->fetch())
{
  $user_name[] = $resultat['name'] .' '. $resultat['surname'];

}

$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($user_name as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : $hint;
?>
