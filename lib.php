<?php
require_once "conf.inc.php";

function dbConnect(){
    try{
        $db = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT,DB_USER,DB_PWD);

    }catch(Exception $e){
        die("Erreur SQL ". $e->getMessage());
    }

    return $db;
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