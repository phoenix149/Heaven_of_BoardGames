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
};

