 <?php include './includes/header.php' ?>
    <main>


        <?php
        //On vérifie qu'il y a un id dans le lien et qu'il n'est pas vide
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            // Requête SQL pour récupérer les informations des jeux 
            $sql = "SELECT j.jeu_id,
        j.jeu_nom AS Nom, 
        j.jeu_img AS Photo, 
        j.jeu_prix,
        jeu_description AS Description, 
        j.jeu_EAN AS EAN, 
        j.jeu_dte_creation, 
        j.jeu_temps, 
        j.jeu_qte_stc, 
        j.jeu_note,
        p.pays_nom AS Pays,
        c.ctg_nom AS Categorie,
        ag.age_nom AS Age,
        m.m_nom AS Mecanisme,
        -- tdj_nom AS Theme,
        a_nom AS Auteur,
        l_nom AS Langue
        FROM Jeu j
        INNER JOIN Pays p ON j.pays_id = p.pays_id
        INNER JOIN Mecanisme m ON j.m_id = m.m_id
        INNER JOIN Categories c ON j.ctg_id = c.ctg_id
        INNER JOIN Age ag ON j.age_id = ag.age_id
        -- INNER JOIN jeu_theme jt ON j.jeu_id = jt.jeu_id
        -- INNER JOIN theme_de_jeu tdj ON jt.tdj_id = tdj.tdj_id
        INNER JOIN jeu_auteurs ja ON j.jeu_id = ja.jeu_id
        INNER JOIN auteurs a ON ja.a_id = a.a_id
        INNER JOIN jeu_langues jl ON j.jeu_id = jl.jeu_id
        INNER JOIN langues l ON jl.l_id = l.l_id
        WHERE j.jeu_id LIKE $id";


            //Requêtes pour récupérer tous les thèmes 
            $themes = $pdo->query("SELECT  tdj_nom FROM jeu_theme jt 
        INNER JOIN theme_de_jeu tj  ON jt.tdj_id = tj.tdj_id
        WHERE jeu_id LIKE $id")->fetchAll(PDO::FETCH_ASSOC);

            // Exécution de la requête
            $jeux = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            // On fait une boucle pour afficher tous les thèmes d'un jeu
            $tm = "";
            foreach ($themes as $theme) {
                foreach ($theme as $th) {
                    $tm .= $th . " ";
                }
            };
        } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
            $getName = $_GET['search'];
            // Requête SQL pour récupérer les informations des jeux 
            $sql = "SELECT j.jeu_id as j_id,
        j.jeu_nom AS Nom, 
        j.jeu_img AS Photo, 
        j.jeu_prix,
        jeu_description AS Description, 
        j.jeu_EAN AS EAN, 
        j.jeu_dte_creation, 
        j.jeu_temps, 
        j.jeu_qte_stc, 
        j.jeu_note,
        p.pays_nom AS Pays,
        c.ctg_nom AS Categorie,
        ag.age_nom AS Age,
        m.m_nom AS Mecanisme,
        -- tdj_nom AS Theme,
        a_nom AS Auteur,
        l_nom AS Langue
        FROM Jeu j
        INNER JOIN Pays p ON j.pays_id = p.pays_id
        INNER JOIN Mecanisme m ON j.m_id = m.m_id
        INNER JOIN Categories c ON j.ctg_id = c.ctg_id
        INNER JOIN Age ag ON j.age_id = ag.age_id
        -- INNER JOIN jeu_theme jt ON j.jeu_id = jt.jeu_id
        -- INNER JOIN theme_de_jeu tdj ON jt.tdj_id = tdj.tdj_id
        INNER JOIN jeu_auteurs ja ON j.jeu_id = ja.jeu_id
        INNER JOIN auteurs a ON ja.a_id = a.a_id
        INNER JOIN jeu_langues jl ON j.jeu_id = jl.jeu_id
        INNER JOIN langues l ON jl.l_id = l.l_id
        WHERE ucase(j.jeu_nom) LIKE ucase('%".$getName."%')";

            // Exécution de la requête
            $jeux = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            foreach($jeux as $game1) { 

            $id = htmlentities($game1['j_id']);

        }

            //Requêtes pour récupérer tous les thèmes 
            $themes = $pdo->query("SELECT  tdj_nom FROM jeu_theme jt 
        INNER JOIN theme_de_jeu tj  ON jt.tdj_id = tj.tdj_id
        WHERE jeu_id LIKE $id")->fetchAll(PDO::FETCH_ASSOC);


            // On fait une boucle pour afficher tous les thèmes d'un jeu
            $tm = "";
            foreach ($themes as $theme) {
                foreach ($theme as $th) {
                    $tm .= $th . " ";
                }
            };
        } else {
            header('Location: index.php');
        }


        ?>

        <article id="mArticleLeft">
            <div class="row">
                <?php foreach ($jeux as $jeu):
                    if ($jeu['jeu_qte_stc'] > 10) {
                        $stockMessage = "Produit en stock";
                    } elseif ($jeu['jeu_qte_stc'] < 11 && $jeu['jeu_qte_stc'] > 0) {

                        $stockMessage = "Attention il ne reste plus que " . $jeu['jeu_qte_stc'] . " exemplaires";
                    } else {

                        $stockMessage = "Produit en rupture de stock";
                    } ?>
                    <section id="gameSelect">
                        <!-- <article id="image" > -->
                        <img id="imageGame" src="<?= htmlentities($jeu['Photo']) ?>" alt="<?= htmlentities($jeu['Nom']) ?>" class="card-img-top p-2">
                        <!-- </article> -->
                        <article id="characteristics">
                            <div>
                                <h3 class="p-2"><strong><?= htmlentities($jeu['Nom']) ?></strong></h3>
                                <p class="card-text"><strong>EAN : </strong><?= htmlentities($jeu['EAN']) ?></p>
                                <p class="card-text"><strong>Note du jeu sur BGG : </strong><?= htmlentities($jeu['jeu_note']) ?></p>
                                <p class="card-text"><strong>Catégorie : </strong><?= htmlentities($jeu['Categorie']) ?></p>
                                <p class="card-text"><strong>Mécanisme : </strong><?= htmlentities($jeu['Mecanisme']) ?></p>
                                <p class="card-text"><strong>Thèmes(s) : </strong><?= htmlentities($tm) ?></p>
                                <p class="card-text"><strong>Pays : </strong><?= htmlentities($jeu['Pays']) ?></p>
                                <p class="card-text"><strong>Langue : </strong><?= htmlentities($jeu['Langue']) ?></p>
                                <p class="card-text"><strong>Auteur(s) : </strong><?= htmlentities($jeu['Auteur']) ?></p>
                                <p class="card-text"><strong>Age : </strong><?= htmlentities($jeu['Age']) ?></p>
                            </div>
                        </article>
                        <article id="basket">
                            <p class="card-text" id="stockMessage"><?= htmlentities($stockMessage) ?></p>
                            <p class="card-text" id="price">Prix TTC : <?= $jeu['jeu_prix'] ?>€</p>
                            <?php if ($stockMessage == "Produit en rupture de stock") {
                                echo "";
                            } else {
                                echo "<button type='submit' name='' class='btn btn-primary'> <span>Ajouter au panier </span></button>";
                            } ?>
                            <a href="edit.php?id=<?= urlencode($id) ?>"><button class="btn btn-primary">Modifier</button></a>

                        </article>
                    </section>
                    
                </div>
            </article>
            <div id="descGame">
                <h5>Description de l'article </h5>
                <p class="card-text"> <?= htmlentities($jeu['Description']) ?></p>
            </div>
            <?php endforeach ?>


    </main>
    <?php include './includes/footer.php' ?>
