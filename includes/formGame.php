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
// echo $pdo;

//Récupération des valeurs saisises
$country = isset($POST["country"]) ? $POST["country"] : "";
$mechanism = isset($POST["mechanism"]) ? $POST["mechanism"] : "";
$category = isset($POST["category"]) ? $POST["category"] : "";
$middleAge = isset($POST["middleAge"]) ? $POST["middleAge"] : "";

//Récupération des Ids
$req1 = "SELECT pays_id from Pays WHERE pays_id = pays_id";

//Traitements des données insérées

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // if ()
    $sql1 = "INSERT into pays_nom (Pays) values ('$country')";
    $sql2 = "INSERT into m_nom (Mecanisme) values ('$mechanism')";
    $sql3 = "INSERT into ctg_nom (Categories) values ('$category')";
    $sql4 = "INSERT into age_nom (Age) values ('$middleAge')";
}
