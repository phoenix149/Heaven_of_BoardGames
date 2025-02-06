<?php include 'includes/header.php' ?>
<main>
    <?php


    error_reporting(0);
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $getName = $_GET['search'];
        // Requête SQL pour récupérer les informations des jeux 
        $sql = "SELECT j.jeu_id as j_id,
j.jeu_nom AS Nom, 
j.jeu_img AS Photo, 
j.jeu_prix,
jeu_description AS Description, 
j.jeu_EAN AS EAN, 
j.jeu_dte_creation, 
j.jeu_nb_joueurs,
j.jeu_temps, 
j.jeu_qte_stc, 
j.jeu_note,
p.pays_nom AS Pays,
c.ctg_nom AS Categorie,
ag.age_nom AS Age,
m.m_nom AS Mecanisme,
-- tdj_nom AS Theme,
a_nom AS Auteur,
l_nom AS Langue,
edit_nom AS Editeur
FROM Jeu j
INNER JOIN Editeur e ON j.edit_id = e.edit_id 
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
WHERE ucase(j.jeu_nom) LIKE ucase('%" . $getName . "%')";

        // Exécution de la requête
        $jeux = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        if (empty($jeux)) {
            echo '<h5 id="titleSearch">Aucun titre ne correspond à votre recherche : "' . $getName . '"</h5>';
        }

        foreach ($jeux as $game1) {

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
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
    }

    ?>
    <section id="mSectionArticle">
        <article id="mArticleLeft">
            <h5 id="titleSearch">Les titres qui correspondent à votre recherche "<?php echo $getName ?>" :</h5>
            <br>
            <div class="row justify-content-center">
                <?php if (count($jeux) > 0): ?>
                    <?php foreach ($jeux as $jeu):  ?>
                        <?php if ($jeu['jeu_qte_stc'] > 0) {
                            $stockMessage = "Produit en stock";
                        } else {

                            $stockMessage = "Produit en rupture de stock";
                        } ?>
                        <div class="col-3 m-1" id="">
                            <a href="games.php?id=<?= urlencode($jeu['j_id']) ?>">
                                <div class="card p-3" id="classLeft">
                                    <div id=i_imgContainer>
                                        <img src="<?= htmlentities($jeu['Photo']) ?>" alt="<?= htmlentities($jeu['Nom']) ?>" class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title"><?= htmlentities($jeu['Nom']) ?></h6>
                                        <p class="card-text" id="price"><strong>Prix TTC : </strong><?= $jeu['jeu_prix'] ?>€</p>
                                        <p class="card-text" id=""><?= htmlentities($stockMessage) ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>

            </div>
        </article>
        <article id="mArticleRight">

        </article>
    </section>
</main>
<?php include 'includes/footer.php' ?>