<?php 
include 'includes/header.php';
//Récupérons l'id du jeu séléctionné
$id = $_GET['id'];
//Préparons nos requêtes pour supprimer d'abord les clés étrangères du jeu :
//Dans la table jeu_theme
$deleteTheme = "DELETE FROM jeu_theme WHERE jeu_id = :id";
$stmt1 = $pdo->prepare($deleteTheme);
//Dans la table jeu_langues
$deleteLanguage = "DELETE FROM jeu_langues WHERE jeu_id = :id";
$stmt2 = $pdo->prepare($deleteLanguage);
//Dans la table jeu_auteurs
$deleteAuthor = "DELETE FROM jeu_auteurs WHERE jeu_id = :id";
$stmt3 = $pdo->prepare($deleteAuthor);
//Et enfin dans le jeu dans la table Jeu
$deleteGame = "DELETE FROM Jeu WHERE jeu_id = :id";
$stmt4 = $pdo->prepare($deleteGame);

//Liaison de la valeur de l'ID
$stmt1->bindValue(":id", $id, PDO::PARAM_INT);
$stmt2->bindValue(":id", $id, PDO::PARAM_INT);
$stmt3->bindValue(":id", $id, PDO::PARAM_INT);
$stmt4->bindValue(":id", $id, PDO::PARAM_INT);

//Exécution de la requête

$stmt1->execute();
$stmt2->execute();
$stmt3->execute();
$stmt4->execute();

//Redirection vers la page d'accueil
// header('location:index.php');
echo '<meta http-equiv="refresh" content="0;url=index.php">';
?>


