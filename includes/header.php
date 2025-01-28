<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Heaven Of BoardGames</title>
</head>
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
?>

<header>
    <section id="hSectionSessionNav">
 
    </section>
    <section id="hSectionTop">
        <aside id="hAsideLogo">
            <a href="index.php"><img src="images/logo.png" alt="" id="hLogo"></a>
        </aside>
        <article id="hArticleSearchbar">

            <h1 id="logoTitre">Heaven of BoardGames</h1>

            <form class="d-flex" role="search" id="hSearch" method="get" action="games.php">
                <input class="form-control me-2" type="search" id="hChampSearch" placeholder="Rechercher un jeu..." aria-label="Search" name="search">
                <button class="btn btn-outline-success" id="hSearchButon" type="submit">Rechercher</button>
            </form>

        </article>
        <article id="hArticlePanierCompte">
            <a class="btn btn-outline-success" id="hMoncompteButon" href="connexion.php">Mon Compte</a>
            <button class="btn btn-outline-success" id="hMonPanierButon">Mon Panier</button>
        </article>
        <aside id="hReseauxTop">
            <h6 id="titreRS">Nos réseaux</h6>
            <a href="#"><img src="images/instagram.png" class="hRSLogo" alt="InstagramLogo"></a>
            <a href="#"><img src="images/facebook.png" class="hRSLogo" alt="FacebookLogo"></a>
            <a href="#"><img src="images/youtube.png" class="hRSLogo" alt="YoutubeLogo"></a>
            <a href="#"><img src="images/tic-tac (1).png" class="hRSLogo" alt="Tik-TokLogo"></a>
            <a href="#"><img src="images/tic.png" class="hRSLogo" alt="TwitchLogo"></a>
        </aside>
    </section>
    <section id="hSectionNavBar">
        <nav id="hNavbar">
            <a href="#">
                <h3 class="hLiensNav">Jeux D'ambiances</h3>
            </a>
            <h3 class="hPipe">|</h3>
            <a href="#">
                <h3 class="hLiensNav">Jeux Enfants</h3>
            </a>
            <h3 class="hPipe">|</h3>
            <a href="#">
                <h3 class="hLiensNav">Jeux Familiaux</h3>
            </a>
            <h3 class="hPipe">|</h3>
            <a href="#">
                <h3 class="hLiensNav">Jeux Initiés</h3>
            </a>
            <h3 class="hPipe">|</h3>
            <a href="#">
                <h3 class="hLiensNav">Jeux Experts</h3>
            </a>
        </nav>
    </section>
    <a href="#hSectionTop"><button id="buttonTop" class="fixed-bottom">↑</button></a>
</header>