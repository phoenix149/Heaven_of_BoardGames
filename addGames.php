<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un jeu!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">

</head>

<body>
    <?php include './includes/header.php' ?>
    <main>
        <?php

        // Récupère les Catégories, Auteurs, Méchanisme, Age, Pays, Langue du jeu
        $categoriesReq = $pdo->query("SELECT ctg_id, ctg_nom from categories")->fetchAll();
        $authors = $pdo->query("SELECT a_id, a_nom from auteurs")->fetchAll();
        $mechanismReq = $pdo->query("SELECT m_id, m_nom from mecanisme")->fetchAll();
        $ageMiddle = $pdo->query("SELECT age_id, age_nom from age")->fetchAll();
        $countryReq = $pdo->query("SELECT pays_id, pays_nom from pays")->fetchAll();
        $languageGames = $pdo->query("SELECT l_id, l_nom from langues")->fetchAll();
        $editorsGames = $pdo->query("SELECT edit_id, edit_nom from editeur")->fetchAll();
        $ThemesGames = $pdo->query("SELECT tdj_id, tdj_nom from theme_de_jeu")->fetchAll();

        ?>
        <br>
        <h4 id="titleForm">Veuillez renseigner les informations concernant le jeu que vous souhaitez ajouter :</h4>
        <section id="">
        <form id="mSForms" action="./formGame.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ean" class="">EAN :</label>
                <input type="text" name="ean" required class="form-control">
            </div>
            <br>
            <div>
                <label for="gameName">Nom du Jeu :</label>
                <input type="text" name="gameName" required class="form-control">
            </div>
            <br>
            <div>
                <label for="noteGame">Note du Jeu sur BGG :</label>
                <input type="text" name="noteGame" id="" maxlength="4" placeholder="1 à 10 exemple : 6.5" class="form-control">
            </div>
            <br>
            <div>
                <label for="gameTheme">Thème du Jeu :</label>
                <select name="gameTheme" id="selectorGameTheme" class="form-select">
                <option value="" hidden></option>
                <option value="Add" >Ajouter un Thème de Jeu</option>
                <option value=" " disabled></option>
                <?php foreach ($ThemesGames as $ThemeGame): ?>
                        <option value="<?= $ThemeGame['tdj_id'] ?>">
                            <?= htmlentities($ThemeGame['tdj_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                <label for="addGameTheme" class="form-label" id="addGameThemeLabel">Ajouter un Thème :</label>
                <input type="text" name="addGameTheme" id="addGameThemeChamp" class="form-control">
            </div>
            <br>
            <div>
                <label for="descGame">Description :</label>
                <textarea name="descGame" id="" class="form-control"></textarea>
            </div>
            <br>
            <div>
                <label for="gamePrice">Prix du Jeu :</label>
                <input type="text" name="gamePrice" required class="form-control">
            </div>
            <br>
            <div>
                <label for="gameTime">Temps de Jeu :</label>
                <input type="text" name="gameTime" id="" class="form-control">
            </div>
            <br>
            <div>
                <label for="middleAge">Age moyen :</label>
                <select name="middleAge" id="" class="form-select">
                <option value="" hidden></option>
                <?php foreach ($ageMiddle as $ageMiddleU): ?>
                        <option value="<?= $ageMiddleU['age_id'] ?>">
                            <?= htmlentities($ageMiddleU['age_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div>
                <label for="nbPlayer">Nombre de Joueurs :</label>
                <input type="text" placeholder="exemple : 2 à 5" name="nbPlayer" class="form-control">
            </div>
            <br>
            <div>
                <label for="author">Auteur :</label>
                <select name="author" id="author" class="form-select">
                <option value="" hidden></option>
                <option value="Add" >Ajouter un Auteur</option>
                <option value=" " disabled></option>
                <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['a_id'] ?>">
                            <?= htmlentities($author['a_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addAuthor" id="addAuthorLabel">Ajouter un Auteur :</label>
                    <input type="text" name="addAuthor" id="addAuthor" class="form-control">
            </div>
            <br>
            <div>
                <label for="editor">Éditeur :</label>
                <select name="editor" id="selectorEditor" class="form-select">
                <option value="" hidden></option>
                <option value="Add" >Ajouter un Éditeur</option>
                <option value=" " disabled></option>
                <?php foreach ($editorsGames as $editorGame): ?>
                        <option value="<?= $editorGame['edit_id'] ?>">
                            <?= htmlentities($editorGame['edit_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addEditor" id="addEditorLabel">Ajouter un Éditeur :</label>
                    <input type="text" name="addEditor" id="addEditorChamp" class="form-control">
            </div>
            <br>
            <div>
                <label for="createDate">Année de sortie :</label>
                <input type="text" name="createDate" maxlength="4" class="form-control">
            </div>
            <br>
            <div>
                <label for="country">Pays d'Origine :</label>
                <select name="country" id="" class="form-select">
                <option value="" hidden></option>
                <option value="Add" >Ajouter un Pays d'origine</option>
                <option value=" " disabled></option>
                <?php foreach ($countryReq as $countryU): ?>
                        <option value="<?= $countryU['pays_id'] ?>">
                            <?= htmlentities($countryU['pays_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                <label for="addCountry" id="addCountryLabel">Ajouter un Éditeur :</label>
                    <input type="text" name="addCountry" id="addCountryChamp" class="form-control">
            </div>
            <br>
            <div>
            <label for="languagesGame">Langue du Jeu :</label>
                <select name="languagesGame" id="" class="form-select">
                <option value="" hidden></option>
                <?php foreach ($languageGames as $languageGame): ?>
                        <option value="<?= $languageGame['l_id'] ?>">
                            <?= htmlentities($languageGame['l_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div>
                <label for="category">Catégorie :</label>
                <select name="category" id="category" class="form-select">
                <option value="" hidden></option>
                <option value="Add" >Ajouter une Catégorie</option>
                <option value=" " disabled></option>
                    <?php foreach ($categoriesReq as $categorie): ?>
                        <option value="<?= $categorie['ctg_id'] ?>">
                            <?= htmlentities($categorie['ctg_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                <label for="addCategory" id="addCategoryLabel">Ajouter une Catégorie :</label>
                <input type="text" name="addCategory" class="form-control" id="addCategoryChamp">
            </div>
            <br>
            <div>
                <label for="mechanism">Mécanisme de Jeu :</label>
                <select name="mechanism" id="mechanism" class="form-select">
                <option value="" hidden></option>
                <option value="Add" >Ajouter un Mécanisme de Jeu</option>
                <option value=" " disabled></option>
                <?php foreach ($mechanismReq as $mechanismU): ?>
                        <option value="<?= $mechanismU['m_id'] ?>">
                            <?= htmlentities($mechanismU['m_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                <label for="addMechanism" id="addMechanismLabel">Ajouter un Méchanisme :</label>
                    <input type="text" name="addMechanism" id="addMechanismChamp" class="form-control">
            </div>
            <br>
            <div>
                <label for="stockGame">Quantité en stock :</label>
                <input type="number" name="stockGame" class="form-control">
            </div>
            <br>
            <div>
                <label for="file" class="form-label">Charger une image :</label>
                <input type="file" id="file" name="file" class="form-control">
            </div>
            <br>
            <div>
                <input type="submit" value="Enregistrer" class="btn btn-secondary">
                <input type="reset" value="Annuler" class="btn btn-secondary">
            </div>
            <br>
        </form>
        </section>
    </main>
    <?php include './includes/footer.php' ?>
   
</body>

</html>