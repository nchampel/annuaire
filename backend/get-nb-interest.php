<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT * FROM interets";
    try {
        $statement = $connexion->prepare($rqt);
        $statement->execute();
        $nbInterest = $statement->fetchAll(PDO::FETCH_ASSOC);
        
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    $results = [];

    for ($i = 1 ; $i <= count($nbInterest) ; $i++) {
        $rqt2 = "SELECT nom, count(centre_interet_id) as nb_adherent FROM interet_adherent LEFT JOIN interets ON interet_adherent.centre_interet_id = interets.interet_id WHERE centre_interet_id = $i";
        try {
            $statement = $connexion->prepare($rqt2);
            $statement->execute();
            $resultsInterest = $statement->fetchAll(PDO::FETCH_ASSOC);
            
        } catch(Exception $exception) {
            echo $exception->getMessage(); 
        }
        $results[] = $resultsInterest;
    }
    // var_dump($results);
    for($j = 0 ; $j < count($results) ; $j++) {
        // var_dump($results[$i]);
        $id = $results[$j][0]['nb_adherent'];
        $nom = utf8_encode($results[$j][0]['nom']);
        $resultsUTF8[] = [
            'nom' => $nom,
            'nb_adherent' => $id
        ];

    }
    

    //On renvoie ces résultats en JSON : 
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($resultsUTF8);
    