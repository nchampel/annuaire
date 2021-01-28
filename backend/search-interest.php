<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    $search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT *, adherents.nom as nom FROM adherents LEFT JOIN profils ON adherents.adherent_id = profils.adherent_id LEFT JOIN interet_adherent ON adherents.adherent_id = interet_adherent.adherent_id LEFT JOIN interets ON interets.interet_id = interet_adherent.centre_interet_id WHERE interets.interet_id = :search";
    try {
        $statement = $connexion->prepare($rqt);
        $statement->bindParam(':search', $search);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    //On renvoie ces résultats en JSON : 
    header('Content-Type: application/json');
    echo json_encode($results);