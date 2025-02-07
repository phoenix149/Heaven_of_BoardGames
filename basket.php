<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <?php include 'includes/header.php' ?>

    <main>
    <?php
    if (isset($_SESSION['panier']) && !empty($_SESSION['panier']) && in_array($_SESSION['panier'], ['Utilisateur'])) {
        echo "<h3>Détails de votre Panier</h3>";
        echo '<ul id="cartList">';
        // foreach ($_SESSION['panier'] as $jeu) {
            echo "<li>{$jeu['nom']}. Prix : {$jeu['prix']}€.</li>";
        }
        echo '</ul>';

        $total = array_sum(array_column($_SESSION['panier'], 'prix'));
        echo "<p>Total : <span id='total'>0</span>{$total}€</p>";
    // } else {
        echo "<p>Le panier est vide.</p>";
    // }
    ?>
        <div id="panier">
            <div id="panier-contenu">
                <h3>Détails de votre Panier</h3>

                <ul id="cartList">

                </ul>
                <p>Total : <span id="total">0</span>€</p>

            </div>
        </div>

    </main>
    <?php include 'includes/footer.php' ?>