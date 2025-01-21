
    <?php


    if (isset($_POST['gameName']) && !empty($_POST['gameName'])) { // Si le champ gameName est initialisé et n'est pas vide
        $gameName = str_replace(" ", "_", $_POST['gameName']); // Je remplace les espaces par des _
        // $requete = new PDO()
        $sql5 = "INSERT into Jeu (jeu_nom) values ('$gameName')"; // Insert la valeur contenue dans $gameName dans le champ jeu_nom de la table jeu
    }

    if (isset($_POST['gamePrice']) && !empty($_POST['gamePrice'])) { // Si le champ gamePrice est initialisé et n'est pas vide
        $gamePrice = trim($_POST['gamePrice']); // Je supprime les espaces
        $sql6 = "INSERT into Jeu (jeu_prix) values ('$gamePrice')"; // Insert la valeur contenue dans $gamePrice dans le champ jeu_prix de la table jeu
    }

    if (isset($_POST['ean']) && !empty($_POST['ean'])) { // Si le champ ean est initialisé et n'est pas vide
        $ean = trim($_POST['ean']); // Je supprime les espaces
        $sql7 = "INSERT into Jeu (jeu_EAN) values ('$ean')"; // Insert la valeur contenue dans $ean dans le champ jeu_EAN de la table jeu
    }

    if (isset($_POST['gameTime']) && !empty($_POST['gameTime'])) { // Si le champ gameTime est initialisé et n'est pas vide
        $gameTime = trim($_POST['gameTime']); // Je supprime les espaces
        $sql8 = "INSERT into Jeu (jeu_temps) values ('$gameTime')"; // Insert la valeur contenue dans $gameTime dans le champ jeu_temps de la table jeu
    }


    if (isset($_POST['createDate']) && !empty($_POST['createDate'])) { // Si le champ createDate est inistialisé et n'est pas vide
        $createDate = str_replace("/", "-", $_POST['createDate']); // Je remplace les "/" par des "-"
        $sql9 = "INSERT into Jeu (jeu_dte_creation) values ('$createDate')"; // Insert la valeur contenue dans $createDate dans le champ jeu_dte_creation de la table jeu
    }





    ?>








