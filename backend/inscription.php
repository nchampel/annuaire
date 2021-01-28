<?php
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $zipcode = filter_var($_POST['zipcode'], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $password = $_POST['password']; // On a le mot de passe saisi par l'utilisateur

    $hasPrefix = strpos($number, "adh-2045-");
    if ($hasPrefix === false) {
        header('Location: ../frontend/inscription.html');
        exit();
    }

    include('db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    // pour afficher les erreurs dans le catch
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //on chiffre le mot de passe
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $rqt = "INSERT INTO adherents (prenom, nom, pseudo, email, numero, adresse1, code_postal, ville, date_adhesion, mot_de_passe) values (:firstname, :lastname, :pseudo, :email, :number, :address, :zipcode, :city, NOW(), :pass)";
    //On prépare notre requête. ça nous renvoie un objet qui est notre requête préparée prête à être executée
    try {
        $statement = $connexion->prepare($rqt);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':pseudo', $pseudo);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':number', $number);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':zipcode', $zipcode);
        $statement->bindParam(':city', $city);
        $statement->bindParam(':pass', $hash);
        //On l'execute
        $statement->execute();
        header('Location: ../frontend/index.html');
        exit();
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }

    
    
?>