<?php
function connectBdd(){
	try{
    $bdd = new PDO(
			DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT, DB_USER, DB_PWD);
	}catch(Exception $e){
		die("Erreur : ".$e->getMessage()); // ="méthode"
	}
    return $bdd;
}

function emailExist($email){
	//connexion à la base de données
	$bdd = connectBdd();
	//Péparation de la requête
	$query = $bdd->prepare("SELECT * FROM member WHERE email = :toto");
	$query -> execute(["toto"=> $email]);
	$result = $query->fetch();
	if (empty($result)) {
		return false;
	}else{
	return true;
    }
}

function isConnected(){
	if (!empty($_SESSION['accesstoken'])){
		$db = connectBdd();
		$connected = $db->prepare("SELECT id, email FROM users WHERE is_deleted is null AND accesstoken = :access_token AND email = :email");
		$connected->execute([
			'access_token'=>$_SESSION["accesstoken"],
			'email'=>$_SESSION['email']
		]);
		if(empty($connected->fetch())){
			unset($_SESSION["accesstoken"]);
			return false;
		}else{
			return true;
		}
	}
}
function disconnected(){
	if(!empty($_SESSION['accesstoken'])){
	$db = connectBdd();
	$query= $db->prepare("UPDATE users set accesstoken=null WHERE email = :email");
	$query->execute(['email'=>$_SESSION['email']]);
	unset($_SESSION["accesstoken"]);
	}
}


function displayArtists(){
	$bdd = connectBdd();
	$query = $bdd -> execute("SELECT name,surname FROM users WHERE is_verified=1");
	$result = $query->fetch();
	foreach ($result as $key) {
		echo $result[$key] .' / ';
	}
}

function sameMotor($idMotor){
    $db=dbConnect();
    $query=$db->prepare("SELECT name,surname FROM USERS WHERE id_MOTOR=:idMotor");
    $query->execute([
        "idMotor"=>$idMotor
    ]);
    foreach ($query->fetchAll() as $value) {
        echo $value["name"]." ".$value["surname"];
    }
}

function sameMean($idMean){
    $db=dbConnect();
    $query=$db->prepare("SELECT name,surname FROM users WHERE id_MEANS=:idMeans");
    $query->execute([
        "idMeans"=>$idMean
    ]);
    foreach ($query->fetchAll() as $value) {
        echo $value["name"]." ".$value["surname"]."<br>";
    }
}

function sameBoth($idMean,$idMotor){
    $db=dbConnect();
    $query=$db->prepare("SELECT name,surname FROM USERS WHERE id_MOTOR=:idMotor AND id_MEANS=:idMean");
    $query->execute([
        "idMotor"=>$idMotor,
        "idMean"=>$idMean
    ]);
    foreach ($query->fetchAll() as $value) {
        echo $value["name"]." ".$value["surname"]."<br>";
    }
}
