<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectez-vous!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php include './includes/header.php'?>
    <main>

    <h1>Bienvenue sur Heaven of BoardGames</h1>
    <p>Veuillez vous connectez pour voir les jeux</p>
    <p>Pas de compte ? <a href="#">S'inscrire</a></p>
        <form action="#" method="post">
            <div>
                <label for="">Identifiant</label>
                <input type="text" name="identifiant" require>
            </div>
            <div>
                <label for="">Mot de passe</label>
                <input type="text" name="mdp" require>
            </div>
            <div>
                <input type="submit" name="connexion" value="Connexion">
            </div>
            <a href="#">Mot de passe oublié ?</a>
        </form>
    </main>

<?php include './includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>