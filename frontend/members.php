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
    <title>Site annuaire - membres</title>
</head>
<body>
    <h2>Membres</h2>
    <p class="right"><a href="../backend/deconnexion.php" class="button btn-deconnexion">Déconnexion</a></p>
    <br />
    <p class="right"><a href="statistiques.php" class="button btn-deconnexion">Statistiques</a></p>
    <div class="member-form-center">
        <form action="" method="GET" class="form-member" id="search-member">
            <label for="search">Recherche parmi les membres</label>
            <input type="text" name="search" id="search">
            
            
            <input type="submit" value="GO" onclick="searchMembers()" class="btn-search" />
        </form>
        <form action="" method="GET" class="form-member" id="search-interest">
            
                <label for="interest">Recherche par centre d'intérêts</label>

                <select name="interest" id="interest">
                    
                </select>
            
            
            <input type="submit" value="GO" onclick="searchInterest()" class="btn-search" />
            
        </form>
    </div>
    <div id="members">

    </div>
    <script src="js/members.js"></script>
</body>

</html>