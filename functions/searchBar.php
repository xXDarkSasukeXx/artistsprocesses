<?php
require('init.php');
$db = connectBdd();
$result = $db->query("SELECT id, name, surname FROM users WHERE is_deleted is null AND status=1 AND is_verified=1");
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
        if (stristr($q, substr($name, 0, $len))){
            if ($hint === "") {
                $hint = $name;
                $theID = array_search($name, $user_name);
                $res_id = $theID + 1;
                $theName = str_replace(' ', '', $name);
            } else {
                $hint .= ", $name";
                $theID = array_search($name, $user_name);
                $res_id = $theID + 1;
                $theName = str_replace(' ', '', $name);
            }
        }
    }
}
// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "no suggestion" : '<a href="artist.php?id='.$res_id.'&name='.$theName.'">'.$hint.'</a>';
?>
