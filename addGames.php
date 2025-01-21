<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jeu!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">

</head>

<body>
    <?php include './includes/header.php' ?>
awninh php
    <main>
        <h2>Veuillez renseigner les informations concernant le jeu.</h2>
        <form id="form1" action="includes/formGame.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="gameName">Nom du Jeu</label>
                <input type="text" name="gameName" require>
            </div>
            <div>
                <label for="gamePrice">Prix du Jeu</label>
                <input type="text" name="gamePrice" require>
            </div>
            <div>
                <label for="ean">EAN</label>
                <input type="text" name="ean" require>
            </div>
            <div>
                <label for="gameTime">Temps de Jeu</label>
                <input type="number" name="gameTime" require>
            </div>
            <div>
                <label for="middleAge">Age moyen</label>
                <input type="number" name="middleAge" require>
            </div>
            <div>
                <label for="createDate">Date de création</label>
                <input type="date" name="createDate" require>
            </div>
            <div>
                <label for="country">Pays</label>
                <input type="text" name="country" require>
            </div>
            <div>
                <label for="category">Catégorie</label>
                <input type="text" name="category" require>
            </div>
            <div>
                <label for="mechanism">Mécanisme de Jeu</label>
                <input type="text" name="mechanism" require>
            </div>
            <div>
                <label for="file">Charger une image</label>
                <input type="file" id="file" name="file">
            </div>
            <div>
                <input type="submit" value="Enregistrer">
            </div>
        </form>
    </main>
    <?php include './includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>