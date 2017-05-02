<?php
session_start();
require "init.php";

$bdd = connectBdd();

$error = FALSE;

if(
    !empty($_POST["email"]) &&
    !empty($_POST["name"]) &&
    !empty($_POST["surname"]) &&
    !empty($_POST["pwd1"]) &&
    isset($_POST["pwd2"]) &&
    !empty($_POST["status"]) &&
    !empty($_POST["birthday"]) &&
    isset($_POST["deathday"]) &&
    isset($_POST["scene"]) &&
    isset($_POST["beginning"]) &&
    isset($_POST["ending"]) &&
    (!empty($_POST["captcha"]) || !empty($_GET["id"]))
    ){

    $_POST['email'] =  strtolower(trim($_POST['email']));
    $_POST['name'] = trim($_POST['name']);
    $_POST['surname'] = trim($_POST['surname']);


    //Vérifier format de l'adresse email
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error = TRUE;
        $_SESSION["error_subscription"][]=1;
    }

    //Vérifier nom 2 caractères mini
    if(strlen($_POST['name']) < 2){
        $error = TRUE;
        $_SESSION["error_subscription"][]=2;
    }

    if($_POST["name"] == $_POST["surname"]){
        $error = TRUE;
        $_SESSION["error_subscription"][]=3;
    }

    //Le mot de passe doit faire entre 8 et 16 caractères
    if(strlen($_POST['pwd1']) <= 6 || strlen($_POST['pwd1']) >= 15 || $_POST["pwd1"]){
        $error = TRUE;
        $_SESSION["error_subscription"][]=4;
    }
    //les mots de passe doivent être identiques
    if($_POST['pwd1'] != $_POST['pwd2']){
        $error = TRUE;
        $_SESSION["error_subscription"][]=5;
    }

    //le statut doit correspondre
    if($_POST['status'] != "0" && $_POST['status'] != "1" && $_POST['status'] != "2"){
        $error = TRUE;
        $_SESSION["error_subscription"][]=6;
    }

    //la date de naissance doit être valide
    list($year, $month, $day) = explode('-', $_POST["birthday"]);
    if(!checkdate($month, $day, $year))
    {
        $error = TRUE;
        $_SESSION["error_subscription"][]=7;
    }else{
        $ilYA120ans = time() - (31536000*120);
        $ilYA10ans = time() - (31536000*10);
        if(strtotime($_POST["birthday"]) < $ilYA120ans || strtotime($_POST["birthday"]) > $ilYA10ans){
            $error = TRUE;
            $_SESSION["error_subscription"][]=7;
        }
    }

    //la date de décès doit être valide
    list($year, $month, $day) = explode('-', $_POST["deathday"]);
    if(!checkdate($month, $day, $year))
    {
        $error = TRUE;
        $_SESSION["error_subscription"][]=8;
    }else{
        if(strtotime($_POST["deathday"]) < strtotime($_POST["birthday"]) && strtotime($_POST["deathday"])!=0){
            $error = TRUE;
            $_SESSION["error_subscription"][]=8;
        }
    }

    //La scene doit correspondre
    if($_POST['scene'] != "0" && $_POST['scene'] != "1"){
        $error = TRUE;
        $_SESSION["error_subscription"][]=9;
    }

    //Début période de reconnaissance invalide
    list($year, $month, $day) = explode('-', $_POST["beginning"]);
    if(!checkdate($month, $day, $year))
    {
        $error = TRUE;
        $_SESSION["error_subscription"][]=10;
    }else{
        if(strtotime($_POST["beginning"]) < strtotime($_POST["birthday"])){
            $error = TRUE;
            $_SESSION["error_subscription"][]=10;
        }
    }

    //Fin période de reconnaissance invalide
    list($year, $month, $day) = explode('-', $_POST["ending"]);
    if(!checkdate($month, $day, $year))
    {
        $error = TRUE;
        $_SESSION["error_subscription"][]=11;
    }else{
        if(strtotime($_POST["ending"]) < strtotime($_POST["beginning"])){
            $error = TRUE;
            $_SESSION["error_subscription"][]=11;
        }
    }

    if(!isset($_GET["id"])){

        //CGU doit exister
        if(empty($_POST["cgu"])){
            $error = TRUE;
            $_SESSION["error_subscription"][]=12;
        }

        //le captcha entré doit correspondre
        if($_POST["captcha"] != $_SESSION['captcha']){
            $error = TRUE;
            $_SESSION["error_subscription"][]=13;
        }
    }


    $id = (empty($_GET["id"]))?-1:$_GET["id"];
    $query = $bdd -> prepare("SELECT id FROM users WHERE email= :email AND id!=:id");
    $query -> execute([

            "email"=>$_POST['email'],
            "id"=>$id

        ]);
    $result = $query->fetch();

    // Email existant en base ?
    if(!empty($result)){
        $error = TRUE;
        $_SESSION["error_subscription"][]=14;
    }

}

if($error){
    $_SESSION["subscription"] = $_POST;
}else{

    $accesstoken = md5(uniqid());
    $mdp = password_hash($_POST['pwd1'], PASSWORD_DEFAULT);
    if(empty($_GET["id"])){
            $query = $bdd->prepare(
                "INSERT INTO users (email, name, surname, password, status, birthday, date_death, scene, best_period_beginning, best_period_ending, accesstoken)
                VALUES (:email,:name,:surname,:password,:status,:birthday,:deathday, :scene, :beginning, :ending, :accesstoken);"
                );
            $query->execute([
                "email"=>$_POST["email"],
                "name"=>$_POST["name"],
                "surname"=>$_POST["surname"],
                "password"=>$mdp,
                "status"=>$_POST["status"],
                "birthday"=>$_POST["birthday"],
                "deathday"=>$_POST["deathday"],
                "scene"=>$_POST["scene"],
                "beginning"=>$_POST["beginning"],
                "ending"=>$_POST["ending"],
                "accesstoken"=>$accesstoken
            ]
);
        }else{
            $query = $bdd->prepare(
                "UPDATE users SET
                email=:email,
                name=:name,
                surname=:surname,
                status=:status,
                birthday=:birthday,
                date_death=:deathday,
                scene=:scene,
                best_period_beginning=:beginning,
                best_period_ending=:ending,
                date_updated=now()
                WHERE id=:id"
            );

            $query->execute([
                "email"=>$_POST["email"],
                "name"=>$_POST["name"],
                "surname"=>$_POST["surname"],
                "password"=>$mdp,
                "status"=>$_POST["status"],
                "birthday"=>$_POST["birthday"],
                "deathday"=>$_POST["deathday"],
                "scene"=>$_POST["scene"],
                "beginning"=>$_POST["beginning"],
                "ending"=>$_POST["ending"],
                "id"=>$_GET["id"]
            ]);

        }



        //header("Location: login.php");

}
