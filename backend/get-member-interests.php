<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    $id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT nom FROM interets LEFT JOIN interet_adherent ON interets.interet_id = interet_adherent.centre_interet_id WHERE interet_adherent.adherent_id = :id";
    try {
        $statement = $connexion->prepare($rqt);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    for($i = 0 ; $i < count($results) ; $i++) {
       
        $nom = utf8_encode($results[$i]['nom']);
        $resultsUTF8[]['nom'] = utf8_encode($results[$i]['nom']);

    }

    //On renvoie ces résultats en JSON : 
    header('Content-Type: application/json');
    echo json_encode($resultsUTF8);