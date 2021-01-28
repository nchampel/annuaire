<?php
    $user = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    // pour afficher les erreurs dans le catch
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $rqt = "SELECT mot_de_passe, adherent_id from adherents where email = :id or pseudo = :id";
    //On prépare notre requête. ça nous renvoie un objet qui est notre requête préparée prête à être executée
    try {
        $statement = $connexion->prepare($rqt);
        $statement->bindParam(':id', $user);
        //On l'execute
        $statement->execute(); 
        // On récupère l'ensemble des résultats dans un tableau
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }

    //On compare les mots avec la fonction password_verify
    if(password_verify($password, $results[0]['mot_de_passe'])) { // si vrai le mot de passe correspond au $hash
        // On vient de récupérer l'utilisateur, on créé sa session
        session_start(); 
        $_SESSION['id_user'] = $results[0]['adherent_id']; // les variable de session sont stockées dans le tableau super global $_SESSION
        
        header('Location: ../frontend/edit-profile.php');
        exit();
        
        
        http_response_code(200);
    } else { // Sinon, on redirige vers index.html pour qu'il retente de se connecter. 
        http_response_code(401); // Non autorisé
        header('Location: ../frontend/index.html');
        exit();
    }
    
?>