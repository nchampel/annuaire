<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    if(empty($_SESSION)) {
        header('Location: index.html');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Site annuaire - statistiques</title>
</head>
<body>
    <h2>Statistiques</h2>
    <p class="right"><a href="../backend/deconnexion.php" class="button btn-deconnexion">Déconnexion</a></p>
    <br />
    <p class="right"><a href="members.php" class="button btn-deconnexion">Retour à la liste des membres</a></p>
    <h3>Le nombre de centre d'intérêt moyen par personne</h3>
    <div id="avg-interest">

    </div>
    <h3>Nombre de personnes par centre d’intérêt</h3>
    <div id="nb-interest">

    </div>
    
    <script src="js/statistiques.js"></script>
</body>

</html>