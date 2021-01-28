<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT * FROM adherents LEFT JOIN profils ON adherents.adherent_id = profils.adherent_id";
    try {
        $statement = $connexion->prepare($rqt);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    //On renvoie ces résultats en JSON : 
    header('Content-Type: application/json');
    echo json_encode($results);