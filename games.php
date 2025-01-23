<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Heaven Of BoardGames</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <main>


        <?php
        // Configuration de la base de données
        $host = 'localhost';
        $dbname = 'fil_rouge';
        $username = 'root';
        $password = '';

        try {
            // Connexion à la base de données
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }


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
        ag.age_nom AS Age,
        m.m_nom AS Mecanisme,
        tdj_nom AS Theme,
        a_nom AS Auteur
        -- l_nom AS Langue
        FROM Jeu j
        INNER JOIN Pays p ON j.pays_id = p.pays_id
        INNER JOIN Mecanisme m ON j.m_id = m.m_id
        INNER JOIN Categories c ON j.ctg_id = c.ctg_id
        INNER JOIN Age ag ON j.age_id = ag.age_id
        INNER JOIN jeu_theme jt ON j.jeu_id = jt.jeu_id
        INNER JOIN theme_de_jeu tdj ON jt.tdj_id = tdj.tdj_id
        INNER JOIN jeu_auteurs ja ON j.jeu_id = ja.jeu_id
        INNER JOIN auteurs a ON ja.a_id = a.a_id
        INNER JOIN jeu_langues jl ON j.jeu_id = jl.jeu_id
        INNER JOIN langues l ON jl.l_id = l.l_id
        ";

        // Exécution de la requête
        $jeux = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <article id="mArticleLeft">
            <div class="row">
                <?php if (count($jeux) > 0): ?>
                    <?php foreach ($jeux as $jeu): ?>
                        <section id="gameSelect">
                            <article id="image" >
                                <img id="imageGame" src="<?= htmlentities($jeu['Photo']) ?>" alt="<?= htmlentities($jeu['Nom']) ?>" class="card-img-top">
                            </article>
                            <article id="characteristics">
                                <div>
                                    <h3 class="p-2"><strong><?= htmlentities($jeu['Nom']) ?></strong></h3>
                                    <p class="card-text"><strong>EAN : </strong><?= htmlentities($jeu['EAN']) ?></p>
                                    <p class="card-text"><strong>Date de Création : </strong><?= htmlentities($jeu['jeu_dte_creation']) ?></p>
                                    <p class="card-text"><strong>Pays : </strong><?= htmlentities($jeu['Pays']) ?></p>
                                    <p class="card-text"><strong>Catégorie : </strong><?= htmlentities($jeu['Categorie']) ?></p>
                                    <p class="card-text"><strong>Age : </strong><?= htmlentities($jeu['Age']) ?></p>
                                    <p class="card-text"><strong>Mécanisme : </strong><?= htmlentities($jeu['Mecanisme']) ?></p>
                                    <p class="card-text"><strong>Thème de Jeu : </strong><?= htmlentities($jeu['Theme']) ?></p>
                                </div>
                                <div>
                                    <h5>Description de l'article </h5>
                                </div>
                            </article>
                            <article id="basket">
                            <p class="card-text"><strong>Prix TTC : </strong><?= number_format($jeu['jeu_prix']) ?>€</p>
                            <p class="card-text"><strong>Auteur(s) : </strong><?= htmlentities($jeu['Auteur']) ?></p>
                            <button type="submit" name=""> <span>Ajouter au panier </span></button>
                            </article>
                        </section>
                    <?php endforeach ?>
                <?php endif ?>

            </div>
        </article>


    </main>
    <?php include './includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>