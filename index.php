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
        <?php include 'includes/carousel.php';
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
                            <div class="col-3 m-4">
                                <a href="games.php?id=<?= urlencode($jeu['jeu_id']) ?>" class="text-decoration-none">
                                    <div class="card p-3" id="classLeft">
                                        <img src="<?= htmlentities($jeu['Photo']) ?>" alt="<?= htmlentities($jeu['Nom']) ?>" class="card-img-top" style="height: auto; width: 100%; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlentities($jeu['Nom']) ?></h5>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>