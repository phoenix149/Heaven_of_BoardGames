<?php include './includes/header.php'; ?>
<?php include 'includes/carousel.php'; ?>
<?php


// ID des thèmes à rechercher
$theme_ids = [6]; // À remplacer par les ID souhaités
$placeholders = implode(',', array_fill(0, count($theme_ids), '?'));


// Requête SQL
$sql = "
    SELECT j.jeu_id AS id_jeu, 
           j.jeu_nom AS Nom, 
           j.jeu_img AS Photo, 
           j.jeu_prix, 
           j.jeu_qte_stc 
    FROM jeu j
    JOIN jeu_theme jt ON j.jeu_id = jt.jeu_id
    JOIN Theme_de_jeu tdj ON jt.tdj_id = tdj.tdj_id
    WHERE tdj.tdj_id IN ($placeholders)
";

$stmt = $pdo->prepare($sql);
$stmt->execute($theme_ids);
$jeux = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<main>
    <section id="mSectionArticle">
        <div class="container mt-5">
            <h2 class="mb-4">Liste des Jeux Enfants</h2>
            <div class="row justify-content-center">
                <?php if (!empty($jeux)): ?>
                    <?php foreach ($jeux as $jeu): ?>
                        <?php
                        $photo = !empty($jeu['Photo']) ? $jeu['Photo'] : 'assets/images/default.jpg';
                        $prix = isset($jeu['jeu_prix']) ? number_format($jeu['jeu_prix'], 2, ',', ' ') . " €" : "Prix non disponible";
                        $stockMessage = ($jeu['jeu_qte_stc'] > 0) ? "Produit en stock" : "Produit en rupture de stock";
                        ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="<?= htmlentities($photo) ?>" alt="<?= htmlentities($jeu['Nom']) ?>"
                                    class="card-img-top" style="height: auto; width: 100%; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlentities($jeu['Nom']) ?></h5>
                                    <p class="card-text"><?= htmlentities($stockMessage) ?></p>
                                    <p class="card-text"><strong>Prix TTC : </strong><?= htmlentities($prix) ?></p>
                                    <a href="games.php?id=<?= $jeu['id_jeu'] ?>" class="btn btn-primary">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center">Aucun jeu trouvé pour ce thème.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>


<?php include './includes/footer.php'; ?>