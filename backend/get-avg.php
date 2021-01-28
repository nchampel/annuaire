<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT count(adherent_id) as nb_adh FROM adherents";
    try {
        $statement = $connexion->prepare($rqt);
        $statement->execute();
        $nbAdh = $statement->fetch(PDO::FETCH_ASSOC);
        
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    $rqt2 = "SELECT count(centre_interet_id) as nb_interest FROM interet_adherent";
    try {
        $statement = $connexion->prepare($rqt2);
        $statement->execute();
        $nbInterest = $statement->fetch(PDO::FETCH_ASSOC);
        
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    $results = $nbInterest['nb_interest'] / $nbAdh['nb_adh'];
    

    //On renvoie ces résultats en JSON : 
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($results);
    