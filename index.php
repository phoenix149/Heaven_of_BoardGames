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
        $sql = "SELECT jeu_nom, 
        jeu_img, 
        jeu_prix, 
        jeu_EAN, 
        jeu_dte_creation, 
        jeu_temps, 
        jeu_qte_stc, 
        jeu_note,
        pays_id,
        ctg_id,
        age_id,
        m_id
        FROM Jeu j
        INNER JOIN Pays p ON Jeu.pays_id = Pays.pays_id
        INNER JOIN Mecanisme m ON j.m_id = m.m_id
        INNER JOIN Categories c ON j.ctg_id = c.ctg_id
        INNER JOIN Age a ON j.age_id = a.age_id";

        // Exécution de la requête
        $jeux = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <section id="mSectionArticle">
            <article id="mArticleLeft">
                <div class="card">
                   <?php if (count($jeux) > 0): ?>
                    <?php foreach($jeux as $jeu): ?> 

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