


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
        <h2>Veuillez renseigner les informations concernant le jeu que vous souhaitez ajouter :</h2>
        <section id="mSForms">
        <form id="form1" action="./formGame.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="ean">EAN :</label>
                <input type="text" name="ean" required>
            </div>
            <br>
            <div>
                <label for="gameName">Nom du Jeu :</label>
                <input type="text" name="gameName" required>
            </div>
            <br>
            <div>
                <label for="noteGame">Note du Jeu sur BGG :</label>
                <input type="text" name="noteGame" id="" maxlength="4" placeholder="Note de 1 à 10">
            </div>
            <br>
            <div>
                <label for="gameTheme">Thème du Jeu :</label>
                <select name="gameTheme" id="">
                    <option value="" hidden></option>
                <?php foreach ($ThemesGames as $ThemeGame): ?>
                        <option value="<?= $ThemeGame['tdj_id'] ?>">
                            <?= htmlentities($ThemeGame['tdj_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                <label for="addGameTheme">Ajouter un Thème à la base de donnée</label>
                <input type="text" name="addGameTheme">
            </div>
            <br>
            <div>
                <label for="descGame">Description :</label>
                <textarea name="descGame" id=""></textarea>
            </div>
            <br>
            <div>
                <label for="gamePrice">Prix du Jeu :</label>
                <input type="text" name="gamePrice" required>
            </div>
            <br>
            <div>
                <label for="gameTime">Temps de Jeu :</label>
                <input type="text" name="gameTime" id="">
            </div>
            <br>
            <div>
                <label for="middleAge">Age moyen :</label>
                <select name="middleAge" id="">
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
                <input type="text" placeholder="format 2 à 5" name="nbPlayer">
            </div>
            <br>
            <div>
                <label for="author">Auteur :</label>
                <select name="author" id="">
                <option value="" hidden></option>
                <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['a_id'] ?>">
                            <?= htmlentities($author['a_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addAuthor">Ajouter un Auteur à la Base de donnée :</label>
                    <input type="text" name="addAuthor" id="">
            </div>
            <br>
            <div>
                <label for="editor">Éditeur :</label>
                <select name="editor" id="">
                <option value="" hidden></option>
                <?php foreach ($editorsGames as $editorGame): ?>
                        <option value="<?= $editorGame['edit_id'] ?>">
                            <?= htmlentities($editorGame['edit_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addEditor">Ajouter un Éditeur à la Base de donnée :</label>
                    <input type="text" name="addEditor" id="">
            </div>
            <br>
            <div>
                <label for="createDate">Date de création :</label>
                <input type="date" name="createDate">
            </div>
            <br>
            <div>
                <label for="country">Origine :</label>
                <select name="country" id="">
                <option value="" hidden></option>
                <?php foreach ($countryReq as $countryU): ?>
                        <option value="<?= $countryU['pays_id'] ?>">
                            <?= htmlentities($countryU['pays_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div>
            <label for="languagesGame">Langue du Jeu :</label>
                <select name="languagesGame" id="">
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
                <select name="category" id="">
                <option value="" hidden></option>
                    <?php foreach ($categoriesReq as $categorie): ?>
                        <option value="<?= $categorie['ctg_id'] ?>">
                            <?= htmlentities($categorie['ctg_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                <label for="addCategory">Ajouter une Catégorie dans la base de donnée</label>
                <input type="text" name="addCategory">
            </div>
            <br>
            <div>
                <label for="mechanism">Mécanisme de Jeu :</label>
                <select name="mechanism" id="">
                <option value="" hidden></option>
                <?php foreach ($mechanismReq as $mechanismU): ?>
                        <option value="<?= $mechanismU['m_id'] ?>">
                            <?= htmlentities($mechanismU['m_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                </select>
                <label for="addMechanism">Ajouter un Méchanisme à la Base de donnée :</label>
                    <input type="text" name="addMechanism" id="">
            </div>
            <br>
            <div>
                <label for="stockGame">Quantité en stock :</label>
                <input type="number" name="stockGame">
            </div>
            <br>
            <div>
                <label for="file">Charger une image :</label>
                <input type="file" id="file" name="file">
            </div>
            <br>
            <div>
                <input type="submit" value="Enregistrer">
                <input type="reset" value="Annuler">
            </div>
            <br>
        </form>
        </section>
    </main>
    <?php include './includes/footer.php' ?>
  
