
    <?php include 'includes/header.php' ?>
    <main>
    <?php if(!empty($_SESSION['message'])){
        echo '<div class="alert alert-success" role="alert">'. $_SESSION['message'].'</div>';
        $_SESSION['message'] = "";
    }
    if(!empty($_SESSION['messageAlert'])){
        echo '<div class="alert alert-danger" role="alert">'. $_SESSION['messageAlert'].'</div>';
        $_SESSION['messageAlert'] = "";
    }
    ?>

        <?php include 'includes/carousel.php';



        // Requête SQL pour récupérer les informations des jeux 
        $sql = "SELECT j.jeu_id,
        j.jeu_nom AS Nom, 
        j.jeu_img AS Photo, 
        j.jeu_prix, 
        j.jeu_EAN AS EAN, 
        j.jeu_dte_creation, 
        j.jeu_temps, 
        j.jeu_qte_stc, 
        j.jeu_note,
        p.pays_nom AS Pays,
        c.ctg_nom AS Categorie,
        a.age_nom AS Age,
        m.m_nom AS Mecanisme
        FROM Jeu j
        INNER JOIN Pays p ON j.pays_id = p.pays_id
        INNER JOIN Mecanisme m ON j.m_id = m.m_id
        INNER JOIN Categories c ON j.ctg_id = c.ctg_id
        INNER JOIN Age a ON j.age_id = a.age_id
        Order by jeu_id desc";

        // Exécution de la requête
        $jeux = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <section id="mSectionArticle">
            <article id="mArticleLeft">
                <div class="row justify-content-center">
                    <?php if (count($jeux) > 0): ?>
                        <?php foreach ($jeux as $jeu):  ?>
                            <?php if ($jeu['jeu_qte_stc'] > 0) {
                        $stockMessage = "Produit en stock";
                    } else {

                        $stockMessage = "Produit en rupture de stock";
                    }?>
                            <div class="col-3 m-1" id="">
                                <a href="games.php?id=<?= urlencode($jeu['jeu_id']) ?>" class="text-decoration-none">
                                    <div class="card p-3" id="classLeft">
                                        <div id = i_imgContainer>
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
    <?php include './includes/footer.php' ?>
