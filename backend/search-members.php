<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    $search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT * FROM adherents LEFT JOIN profils ON adherents.adherent_id = profils.adherent_id 
    WHERE pseudo LIKE :search OR nom LIKE :search OR prenom LIKE :search";
    try {
        $statement = $connexion->prepare($rqt);
        $word = "%" . $search . "%";
        $statement->bindParam(':search', $word);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    //On renvoie ces résultats en JSON : 
    header('Content-Type: application/json');
    echo json_encode($results);