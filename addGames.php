    <?php include 'includes/header.php' ?>
    <main>
        <?php
        
        // Si l'utilisateur n'est pas un admin ou un commercial il sera redirigé
        if(!isset($_SESSION['user_type']) || !in_array($_SESSION['user_type'], ['Commercial', 'Admin'])) {
            $_SESSION['messageAlert'] = "Vous n'avez pas l'autorisation d'accéder à cette page";
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        
        }

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
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h1 class="modal-title col-6 p-3 justify-content-center fs-5" id="exampleModalLabel">
                            Jeu ajouté avec succès
                        </h1>
                        <!-- <button
                  type="button"
                  class="btn-close btnClose"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button> -->
                    </div>
                    <div class="modal-body">
                        <p>
                            Merci pour ce nouveau Jeu!
                        </p>

                    </div>
                    <div class="modal-footer">
                        <button id="btnFermer"
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                            Fermer
                        </button>
                        <!-- <button type="button" class="btn btn-primary">
                  Save changes
                </button> -->
                    </div>
                </div>
            </div>
        </div>


        <section id="">
            <form id="addGame" action="formGame.php" method="post" enctype="multipart/form-data">
                <h1>Veuillez renseigner les informations concernant 
                    <br>le jeu que vous souhaitez ajouter :</h1>
                <div class="form-group">
                    <label for="ean" class="">EAN :</label>
                    <input type="text" name="ean" class="form-control" id="ean">
                    <p class="para" id="paraEAN"></p>
                </div>

                <div>
                    <label for="gameName">Nom du Jeu :</label>
                    <input type="text" name="gameName" class="form-control" id="gameName">
                    <p class="para" id="paraGameName"></p>
                </div>

                <div>
                    <label for="noteGame">Note du Jeu sur BGG :</label>
                    <input type="text" name="noteGame" id="noteGame" maxlength="4" placeholder="1 à 10 exemple : 6.5" class="form-control">
                    <p class="para" id="paraNoteGame"></p>
                </div>

                <div>
                    <label for="gameTheme">Thème du Jeu :</label>
                    <select name="gameTheme" id="selectorGameTheme" class="form-select">
                        <option value="" hidden></option>
                        <option value="Add">Ajouter un Thème de Jeu</option>
                        <option value=" " disabled></option>
                        <?php foreach ($ThemesGames as $ThemeGame): ?>
                            <option value="<?= $ThemeGame['tdj_id'] ?>">
                                <?= htmlentities($ThemeGame['tdj_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addGameTheme" class="form-label" id="addGameThemeLabel">Ajouter un Thème :</label>
                    <input type="text" name="addGameTheme" id="addGameThemeChamp" class="form-control">
                    <p class=" para" id="paraGametheme"></p>

                </div>

                <div>
                    <label for="descGame">Description :</label>
                    <textarea name="descGame" id="descriptionGame" class="form-control"></textarea>
                    <p class="para" id="paraDesc"></p>
                </div>

                <div>
                    <label for="gamePrice">Prix du Jeu :</label>
                    <input type="text" name="gamePrice" class="form-control" id="gamePrice">
                    <p class="para" id="paraGamePrice"></p>
                </div>

                <div>
                    <label for="gameTime">Temps de Jeu :</label>
                    <input type="text" name="gameTime" id="gameTime" class="form-control">
                    <p class="para" id="paraGameTime"></p>
                </div>

                <div>
                    <label for="middleAge">Age moyen :</label>
                    <select name="middleAge" id="middleAge" class="form-select">
                        <option value="" hidden></option>
                        <?php foreach ($ageMiddle as $ageMiddleU): ?>
                            <option value="<?= $ageMiddleU['age_id'] ?>">
                                <?= htmlentities($ageMiddleU['age_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="para" id="paraAge"></p>
                </div>

                <div>
                    <label for="nbPlayer">Nombre de Joueurs :</label>
                    <input type="text" placeholder="exemple : 2 à 5" name="nbPlayer" class="form-control" id="nbPlayer">
                    <p class="para" id="paraPlayer"></p>
                </div>

                <div>
                    <label for="author">Auteur :</label>
                    <select name="author" id="author" class="form-select">
                        <option value="" hidden></option>
                        <option value="Add">Ajouter un Auteur</option>
                        <option value=" " disabled></option>
                        <?php foreach ($authors as $author): ?>
                            <option value="<?= $author['a_id'] ?>">
                                <?= htmlentities($author['a_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addAuthor" id="addAuthorLabel">Ajouter un Auteur :</label>
                    <input type="text" name="addAuthor" id="addAuthor" class="form-control">
                    <p class="para" id="paraAuthor"></p>
                </div>

                <div>
                    <label for="editor">Éditeur :</label>
                    <select name="editor" id="selectorEditor" class="form-select">
                        <option value="" hidden></option>
                        <option value="Add">Ajouter un Éditeur</option>
                        <option value=" " disabled></option>
                        <?php foreach ($editorsGames as $editorGame): ?>
                            <option value="<?= $editorGame['edit_id'] ?>">
                                <?= htmlentities($editorGame['edit_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addEditor" id="addEditorLabel">Ajouter un Éditeur :</label>
                    <input type="text" name="addEditor" id="addEditorChamp" class="form-control">
                    <p class="para" id="paraEditor"></p>
                </div>

                <div>
                    <label for="createDate">Année de sortie :</label>
                    <input type="text" name="createDate" maxlength="4" class="form-control" id="createDate">
                    <p class="para" id="paraDate"></p>
                </div>

                <div>
                    <label for="country">Pays d'Origine :</label>
                    <select name="country" id="country" class="form-select">
                        <option value="" hidden></option>
                        <option value="Add">Ajouter un Pays d'origine</option>
                        <option value=" " disabled></option>
                        <?php foreach ($countryReq as $countryU): ?>
                            <option value="<?= $countryU['pays_id'] ?>">
                                <?= htmlentities($countryU['pays_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addCountry" id="addCountryLabel">Ajouter un Pays d'origine :</label>
                    <input type="text" name="addCountry" id="addCountryChamp" class="form-control">
                    <p class="para" id="paraCountry"></p>
                </div>

                <div>
                    <label for="languagesGame">Langue du Jeu :</label>
                    <select name="languagesGame" id="languagesGame" class="form-select">
                        <option value="" hidden></option>
                        <?php foreach ($languageGames as $languageGame): ?>
                            <option value="<?= $languageGame['l_id'] ?>">
                                <?= htmlentities($languageGame['l_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="para" id="paraLanguage"></p>
                </div>

                <div>
                    <label for="category">Catégorie :</label>
                    <select name="category" id="category" class="form-select">
                        <option value="" hidden></option>
                        <option value="Add">Ajouter une Catégorie</option>
                        <option value=" " disabled></option>
                        <?php foreach ($categoriesReq as $categorie): ?>
                            <option value="<?= $categorie['ctg_id'] ?>">
                                <?= htmlentities($categorie['ctg_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addCategory" id="addCategoryLabel">Ajouter une Catégorie :</label>
                    <input type="text" name="addCategory" class="form-control" id="addCategoryChamp">
                    <p class="para" id="paraCategory"></p>
                </div>

                <div>
                    <label for="mechanism">Mécanisme de Jeu :</label>
                    <select name="mechanism" id="mechanism" class="form-select">
                        <option value="" hidden></option>
                        <option value="Add">Ajouter un Mécanisme de Jeu</option>
                        <option value=" " disabled></option>
                        <?php foreach ($mechanismReq as $mechanismU): ?>
                            <option value="<?= $mechanismU['m_id'] ?>">
                                <?= htmlentities($mechanismU['m_nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="addMechanism" id="addMechanismLabel">Ajouter un Méchanisme :</label>
                    <input type="text" name="addMechanism" id="addMechanismChamp" class="form-control">
                    <p class="para" id="paraMechanism"></p>
                </div>

                <div>
                    <label for="stockGame">Quantité en stock :</label>
                    <input type="number" name="stockGame" class="form-control" id="stockGame">
                    <p class="para" id="paraStock"></p>
                </div>

                <div>
                    <label for="file" class="form-label">Charger une image :</label>
                    <input type="file" id="file" name="file" class="form-control">
                    <p class="para" id="paraFile"></p>
                </div>

                <div>
                    <input type="button"  id="save" value="Enregistrer" class="btn btn-secondary" >
                    <input type="reset" value="Annuler" class="btn btn-secondary">
                </div>

            </form>
        </section>
    
    </main>

    <?php include 'includes/footer.php' ?>
