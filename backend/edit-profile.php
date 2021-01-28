<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    $interest = $_POST['interest'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    // Vérifions si on a sélectionné entre 3 et 8 centres d'intérêt
    if( !is_null($interest) && 3 <= count($interest) && count($interest) <= 8) {
        include('db.php');
        $connexion = new PDO($url, $userBDD, $pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        for ($i = 0 ; $i < count($_POST['interest']) ; $i ++) {
            $rqt = "INSERT INTO interet_adherent (adherent_id, centre_interet_id) VALUES (:id, :interet)";
            try {
                $statement = $connexion->prepare($rqt);
                $statement->bindParam(':id', $_SESSION['id_user']);
                $statement->bindParam(':interet', $_POST['interest'][$i]);
                $statement->execute();
            } catch(Exception $exception) {
                echo $exception->getMessage(); 
            }
        }
    } else {
        header('Location: ../frontend/edit-profile.html');
        exit();
    }
    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['photo']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $fileInfo = pathinfo($_FILES['photo']['name']);
            $extensionUpload = $fileInfo['extension'];
            $authorizedExtensions = array('jpg', 'gif', 'png');
            if (in_array($extensionUpload, $authorizedExtensions))
                {
                    // On peut valider le fichier et le stocker définitivement
                    $path = '../uploads/' . "photo_" . rand(1, 1000000) . "." . $extensionUpload;
                    move_uploaded_file($_FILES['photo']['tmp_name'], $path);

                    // stockage en bdd
                    $rqtProfile = "INSERT INTO profils (photo, adherent_id, description, titre) values (:url, :id, :description, :title)";
                    try {
                        $statement = $connexion->prepare($rqtProfile);
                        $statement->bindParam(':url', $path);
                        $statement->bindParam(':id', $_SESSION['id_user']);
                        $statement->bindParam(':title', $title);
                        $statement->bindParam(':description', $description);
                        $statement->execute();
                    } catch(Exception $exception) {
                        echo $exception->getMessage(); 
                    }
                }
            }
    } else {
        header('Location: ../frontend/edit-profile.html');
        exit();
    }

    header('Location: ../frontend/members.php');
    exit();

