<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Heaven Of BoardGames</title>
</head>

<body>
<?php
// Démarrer la session
session_start();
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

 // Vérifiez si l'utilisateur est connecté
 $username = null;
 if (isset($_SESSION['user_id'])) {
     $userId = $_SESSION['user_id'];

     // Récupération des informations de l'utilisateur
     $sqlUser = "SELECT u_pseudo FROM utilisateurs WHERE tu_id = :userId";
     $stmtUser = $pdo->prepare($sqlUser);
     $stmtUser->execute(['userId' => $userId]);
     $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

     if ($user) {
         $username = $user['Login'];
     }
 }

 // Vérifier si l'utilisateur est commercial ou admin
 $isCommercialOrAdmin = isset($_SESSION['user_type']) && in_array($_SESSION['user_type'], ['Commercial', 'Admin']);
 


?>

<nav class="navbar navbar-expand-lg 
    <?php
    // Appliquer des classes spécifiques selon le type d'utilisateur
    if (isset($_SESSION['user_type'])) {
        switch ($_SESSION['user_type']) {
            case 'Commercial':
            case 'SAV':
                echo 'bg-success'; // Vert pour Commercial et SAV
                break;
            case 'Admin':
                echo 'bg-danger'; // Rouge pour Admin
                break;
            default:
                echo 'bg-body-tertiary'; // Couleur par défaut
                break;
        }
    } else {
        echo 'bg-body-tertiary'; // Couleur par défaut si non connecté
    }
    ?>">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Heaven of BoardGames</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php if ($isCommercialOrAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="addGame.php">Ajouter un produit</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="games.php">Toutes les catégories</a></li>
                                <li><a class="dropdown-item" href="Categorie.php">Ajouter une catégorie</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="d-flex">
                    <?php if ($username): ?>
                        <span class="navbar-text me-3">Bienvenue, <?= htmlentities($username) ?>!</span>
                        <a href="deconnexion.php" class="btn btn-danger">Se déconnecter</a>
                    <?php else: ?>
                        <a href="connexion.php" class="btn btn-outline-primary me-2">Login</a>
                        <a href="inscription.php" class="btn btn-primary">Register</a>
                    <?php endif; ?>
                </div>
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>


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
            <a href="jeux_enfants.php">
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