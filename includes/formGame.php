<?php

// Configuration de la base de données
$host = 'localhost';
$dbname = 'fil_rouge';
$username = 'root';
$password = '';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
// $conn 
// echo $pdo;

//Récupération des valeurs saisises
$country = isset($_POST["country"]) && !empty($_POST["country"]) ? $_POST["country"] : "";
$mechanism = isset($_POST["mechanism"]) && !empty($_POST["mechanism"]) ? $_POST["mechanism"] : "";
$category = isset($_POST["category"]) && !empty($_POST["category"]) ? $_POST["category"] : "";
$middleAge = isset($_POST["middleAge"]) && !empty($_POST["middleAge"]) ? $_POST["middleAge"] : "";

//Récupération des Ids
$req1 = "SELECT pays_nom from Pays JOIN Jeu ON Jeu.pays_id = Pays.pays_id";
$req2 = "SELECT m_nom FROM Mecanisme JOIN Jeu ON Jeu.m_id = Mecanisme.m_id";
$req3 = "SELECT ctg_nom FROM Categories JOIN Jeu ON Jeu.ctg_id = Categories.ctg_id";
$req4 = "SELECT age_nom FROM Age JOIN Jeu ON Jeu.age_id = Age.age_id";

// Exécution des requêtes 
$result1 = $pdo->query($req1);
$result2 = $pdo->query($req2);
$result3 = $pdo->query($req3);
$result4 = $pdo->query($req4);

//Traitements des données insérées

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($result1->rowCount() == 0) {
        $sql1 = "INSERT into Pays (pays_nom) values ('$country')";
        $pdo->exec($sql1);
    };
    if ($result2->rowCount() == 0) {
        $sql2 = "INSERT into Mecanisme (m_nom) values ('$mechanism')";
        $pdo->exec($sql2);
    };
    if ($result3->rowCount() == 0) {
        $sql3 = "INSERT into  Categories (ctg_nom) values ('$category')";
        $pdo->exec($sql3);
    };
    if ($result4->rowcount() == 0) {
        $sql4 = "INSERT into Age (age_nom) values ('$middleAge')";
        $pdo->exec($sql4);
    };





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
};
