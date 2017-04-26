<?php
function connectBdd(){
	try{
    $bdd = new PDO("mysql:host=localhost;dbname=artistsprocesses;port=3306", "root", "");
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

/*function generateAccessToken($email){
    $accesstoken = md5(uniqid());
    $bdd = connectBdd();
    $query = $bdd->prepare("UPDATE member SET accesstoken = :titi WHERE email = :tyty");
    $query -> execute(["titi"=> $accesstoken, "tyty" =>$email]);

    return $accesstoken;
}*/

function isConnected(){
    if (!empty($_SESSION["accesstoken"])) {
        $bdd = connectBdd();
        $query = $bdd->prepare("SELECT id FROM member WHERE email = :email AND accesstoken = :accesstoken");
        $query->execute(["email"=>$_SESSION['email'], "accesstoken"=>$_SESSION['accesstoken']]);
        $result = $query->fetch();
        if (empty($result)) {
            //$_SESSION['accesstoken'] = generateAccessToken($_SESSION['email']);
            unset($_SESSION["accesstoken"]);
            return false;
        }else{
            return true;
        }
    }
}

function logout(){

    if(!empty($_SESSION["accesstoken"])){

    $bdd = connectBdd();
    $query = $bdd -> prepare("UPDATE member SET accesstoken=null WHERE email=:email");
    $query -> execute([

        "email"=>$_SESSION["email"]

    ]);

    }
    unset($_SESSION["accesstoken"]);
    header("Location: backOffice.php");
    
}