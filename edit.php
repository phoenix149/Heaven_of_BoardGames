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
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $id=$_POST['id'];
            $uploads_dir = 'images/';
            $tmp_name = $_FILES['file']['tmp_name'];
            $filename = uniqid() . '_' . basename($_FILES['file']['name']);
            $file_path = $uploads_dir . $filename;
        
            if (move_uploaded_file($tmp_name, $file_path)) {
                $photo = $file_path;
            } else {
                $message = "Erreur lors de l'upload de la photo.";
            }
        
        
            
            $sql= "UPDATE `jeu` SET `jeu_img` = :jeu_img WHERE `jeu_id` LIKE $id";

        
            $request= $pdo->prepare($sql);
        
            $request->bindValue(":jeu_img", $photo);
        
            $request->execute();
        }
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
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $uploads_dir = 'images/';
                $tmp_name = $_FILES['file']['tmp_name'];
                $filename = uniqid() . '_' . basename($_FILES['file']['name']);
                $file_path = $uploads_dir . $filename;
            
                if (move_uploaded_file($tmp_name, $file_path)) {
                    $photo = $filename;
                } else {
                    $message = "Erreur lors de l'upload de la photo.";
                }
            
            
                $sql= "UPDATE `jeu` SET `jeu_img` = :jeu_img WHERE `jeu_id` LIKE $id";

            
                $request= $pdo->prepare($sql);
            
                $request->bindValue(":jeu_img", $photo);
            
                $request->execute();
            }
            
            
        } elseif (isset($_GET['search']) && !empty($_GET['search'])) {
            $getName = $_GET['search'];
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
        WHERE ucase(j.jeu_nom) LIKE ucase('%" . $getName . "%')";

            // Exécution de la requête
            $jeux = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

            foreach ($jeux as $game1) {

                $id = htmlentities($game1['j.jeu_id']);
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
        } 
        // else {
        //     header('Location: index.php');
        // }

// Gestion de l'upload de fichier

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
                        <form method="post" class="form-group" enctype="multipart/form-data">
                        <!-- <article id="image" > -->
                        <input type="text" name="id"class="form-control" value="<?= htmlentities($jeu['jeu_id']) ?>" hidden>
                        <img id="imageGame" src="<?= htmlentities($jeu['Photo']) ?>" class="">
                        <!-- </article> -->
                        <div class="mb-3">
                            <label for="file" class="">Remplacer l'image</label>
                            <input type="file" id="file" name="file">
                        </div>
                        <article id="characteristics">
                            <div>
                                <p class="card-text"><strong>Nom du jeu : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['Nom']) ?>">
                                <p class="card-text"><strong>EAN : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['EAN']) ?>"></p>
                                <p class="card-text"><strong>Note du jeu sur BGG : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['jeu_note']) ?>"></p>
                                <p class="card-text"><strong>Catégorie : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['Categorie']) ?>"></p>
                                <p class="card-text"><strong>Mécanisme : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['Mecanisme']) ?>"></p>
                                <p class="card-text"><strong>Thèmes(s) : </strong><input type="text" class="form-control" value="<?= htmlentities($tm) ?>"></p>
                                <p class="card-text"><strong>Pays : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['Pays']) ?>"></p>
                                <p class="card-text"><strong>Langue : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['Langue']) ?>"></p>
                                <p class="card-text"><strong>Auteur(s) : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['Auteur']) ?>"></p>
                                <p class="card-text"><strong>Age : </strong><input type="text" class="form-control" value="<?= htmlentities($jeu['Age']) ?>"></p>
                            </div>
                        </article>
                        <article id="basket">
                            <p class="card-text" id="stockMessage"><?= htmlentities($stockMessage) ?></p>
                            <p class="card-text"></strong><input type="text" class="form-control" value="<?= htmlentities($jeu['jeu_qte_stc']) ?>"></p>
                            </p>
                            <p class="card-text" id="price" name="">Prix TTC : <?= $jeu['jeu_prix'] ?>€</p>
                            <button type="submit" class="btn btn-primary">Confirmer</button>
                        </article>
                    </section>
                <?php endforeach ?>

            </div>
        </article>
        <div id="descGame">
            <h5>Description de l'article : </h5>
            <p class="card-text"><input type="text" class="form-control" value="<?= htmlentities($jeu['Description']) ?>"></p>
        </div>
        </form>


    </main>
    <?php include './includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>