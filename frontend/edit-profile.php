<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    
    include('../backend/db.php');
    $connexion = new PDO($url, $userBDD, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $rqt = "SELECT * FROM profils WHERE adherent_id = :id";
    try {
        $statement = $connexion->prepare($rqt);
        $id = filter_var($_SESSION['id_user'], FILTER_SANITIZE_STRING);
        $statement->bindParam(':id', $id);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(Exception $exception) {
        echo $exception->getMessage(); 
    }
    if(!empty($results)) {
        header('Location: members.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Site annuaire - édition profil</title>
</head>
<body>
    <h2>Profil</h2>
    <p>Choisissez entre 3 et 8 centres d'intérêt</p>
    <form action="../backend/edit-profile.php" method="POST" enctype="multipart/form-data">
        <div class="checkboxes">
            <div class="check-field">
                <input type="checkbox" id="sport" name="interest[]" value="1">
                <label for="sport">Sport</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="music" name="interest[]" value="2">
                <label for="music">Musique</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="video-games" name="interest[]" value="3">
                <label for="video-games">Jeux vidéos</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="reading" name="interest[]" value="4">
                <label for="reading">Lecture</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="informatic" name="interest[]" value="5">
                <label for="informatic">Informatique</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="outings" name="interest[]" value="6">
                <label for="outings">Sorties</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="cooking" name="interest[]" value="7">
                <label for="cooking">Cuisine</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="aviation" name="interest[]" value="8">
                <label for="aviation">Aviation</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="mecanic" name="interest[]" value="9">
                <label for="mecanic">Mécanique</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="unicorns" name="interest[]" value="10">
                <label for="unicorns">Licornes</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="jewellery" name="interest[]" value="11">
                <label for="jewellery">Joaillerie</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="farming" name="interest[]" value="12">
                <label for="farming">Agriculture</label> 
            </div>
            <div class="check-field">
                <input type="checkbox" id="cinema" name="interest[]" value="13">
                <label for="cinema">Cinéma</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="politics" name="interest[]" value="14">
                <label for="politics">Politique</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="sewing" name="interest[]" value="15">
                <label for="sewing">Couture</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="animals" name="interest[]" value="16">
                <label for="animals">Animaux</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="science" name="interest[]" value="17">
                <label for="science">Science</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="history" name="interest[]" value="18">
                <label for="history">Histoire</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="svt" name="interest[]" value="19">
                <label for="svt">SVT</label>
            </div>
            <div class="check-field">
               <input type="checkbox" id="chemistry" name="interest[]" value="20">
                <label for="chemistry">Physique-Chimie</label> 
            </div>
            <div class="check-field">
                <input type="checkbox" id="taxidermy" name="interest[]" value="21">
                <label for="taxidermy">Taxidermie</label>
            </div>
            <div class="check-field">
                <input type="checkbox" id="philately" name="interest[]" value="22">
                <label for="philately">Philatélie</label>
            </div>
            
        </div>
        <div id="tags">
        </div>
        <input type="text" name="title" id="title" placeholder="Titre">
        <br />
        <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>
        <br />
        <label for="avatar">Avatar (&lt; 1Mo, jpg, gif ou png)</label>
        <input type="file" name="photo" id="avatar" accept="image/png, image/jpg, image/gif">
        <br />
        <input type="submit" class="button" value="Enregistrer" />
    </form>
    <script src="js/main.js"></script>
</body>
</html>