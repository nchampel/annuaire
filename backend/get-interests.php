<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT interet_id, nom FROM interets";
    try {
        $statement = $connexion->prepare($rqt);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    
    for($i = 0 ; $i < count($results) ; $i++) {
        $id = $results[$i]['interet_id'];
        $nom = utf8_encode($results[$i]['nom']);
        $resultsUTF8[] = [
            'interet_id' => $id,
            'nom' => $nom
        ];

    }
    //On renvoie ces résultats en JSON : 
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($resultsUTF8);
    