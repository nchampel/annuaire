<?php
    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    if(empty($_SESSION)) {
        header('Location: index.html');
        exit();
    }
    $id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Site annuaire - membres</title>
</head>
<body>
    <h2>Profil</h2>
    <p class="right"><a href="../backend/deconnexion.php" class="button btn-deconnexion">Déconnexion</a></p>
    <br />
    <p class="right"><a href="members.php" class="button btn-deconnexion">Retour à la liste des membres</a></p>
    
    <div id="member">

    </div>
    <script>
        id = <?php echo $id;?>;
    </script>
    <script src="js/member.js"></script>
</body>

</html>