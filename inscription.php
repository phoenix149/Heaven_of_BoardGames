<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Incription</title>
</head>
<body>
<?php include './includes/header.php'?>
    <main>
        <h1>Créer un compte</h1>
        <p>Veuillez remplir les champs suivants :</p>

        <form action="" method="post">
            <div>
                <label for="">Nom</label>
                <input type="text" name="" require>
            </div>
            <div>
                <label for="">Prénom</label>
                <input type="text" name="" require>
            </div>
            <div>
                <label for="">Pseudo (optionnel)</label>
                <input type="text" name="" >
            </div>
            <div>
                <label for="">Date de naissance</label>
                <input type="number" name="" require>
            </div>
            <div>
                <p>Adresse</p>
                <label for="">N° de rue</label>
                <input type="number" name="" require>
            </div>
            <div>
                <label for="">Nom de rue</label>
                <input type="text" name="" require>
            </div>
            <div>
                <label for="">Complément d'adresse</label>
                <input type="text" name="">
            </div>
            <div>
                <label for="">Code postal</label>
                <input type="number" name="" require>
            </div>
            <div>
                <label for="">Ville</label>
                <input type="text" name="" require>
            </div>
            <div>
                <label for="">N° de téléphone</label>
                <input type="number" name="" require>
            </div>
            <div>
                <label for="">Mail</label>
                <input type="text" name="" require>
            </div>
            <div>
                <label for="">Créer un mot de passe</label>
                <input type="text" name="" require>
            </div>
            <div>
                <label for="">Confirmer mot de passe</label>
                <input type="text" name="" require>
            </div>
            <div>
                <input type="submit" value="Confirmer">
                <input type="reset" value="Annuler">
            </div>
        </form>
    </main>
    <?php include './includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>