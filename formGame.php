<?php include './includes/header.php' ?>
<?php
echo "<main>";


// Gestion de l'upload de fichier
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
}
$modifBDDAuthors = false;
$modifBDDEditors = false;
$modifBDDMechanism = false;
$modifBDDTheme = false;
$modifBDDCategory = false;

// Ajouter un Auteur à la base de donnée

if (isset($_POST['addAuthor']) && !empty($_POST['addAuthor'])) {

    $addAuthor = $_POST['addAuthor'];

    // J'écris ma requête SQL
    $sql = "INSERT INTO `auteurs` (`a_nom`) values (:a_nom)";

    // Je prépare ma requête
    $request = $pdo->prepare($sql);

    // J'injecte mes valeurs
    $request->bindValue(":a_nom", $addAuthor, PDO::PARAM_STR);

    // J'éxécute ma requête
    $request->execute();

    $modifBDDAuthors = true;
    $idNewAuthor = $pdo->lastInsertId();
}
// Ajouter une Categorie à la base de donnée
if (isset($_POST['addCategory']) && !empty($_POST['addCategory'])) {

    $addCategory = $_POST['addCategory'];

    // J'écris ma requête SQL
    $sql = "INSERT INTO `categories` (`ctg_nom`) values (:ctg_nom)";

    // Je prépare ma requête
    $request = $pdo->prepare($sql);

    // J'injecte mes valeurs
    $request->bindValue(":ctg_nom", $addCategory, PDO::PARAM_STR);

    // J'éxécute ma requête
    $request->execute();

    $modifBDDCategory = true;
    $idNewCategory = $pdo->lastInsertId();
}

//Ajouter un nouveau Thème à la base de donnée
if (isset($_POST['addGameTheme']) && !empty($_POST['addGameTheme'])) {

    $addGameTheme = $_POST['addGameTheme'];

    // J'écris ma requête SQL
    $sql = "INSERT INTO `theme_de_jeu` (`tdj_nom`) values (:tdj_nom)";

    // Je prépare ma requête
    $request = $pdo->prepare($sql);

    // J'injecte mes valeurs
    $request->bindValue(":tdj_nom", $addGameTheme, PDO::PARAM_STR);

    // J'éxécute ma requête
    $request->execute();

    $modifBDDTheme = true;
    $idNewTheme = $pdo->lastInsertId();
}

// Ajouter un Méchanisme à la base de donnée
if (isset($_POST['addMechanism']) && !empty($_POST['addMechanism'])) {

    $addMechanism = $_POST['addMechanism'];

    // J'écris ma requête SQL
    $sql = "INSERT INTO `mecanisme` (`m_nom`) values (:m_nom)";

    // Je prépare ma requête
    $request = $pdo->prepare($sql);

    // J'injecte mes valeurs
    $request->bindValue(":m_nom", $addMechanism, PDO::PARAM_STR);

    // J'éxécute ma requête
    $request->execute();

    $modifBDDMechanism = true;
    $idNewMechanism = $pdo->lastInsertId();
}
// Ajouter un nouvel éditeur à la base de donnée
if (isset($_POST['addEditor']) && !empty($_POST['addEditor'])) {

    $addEditor = $_POST['addEditor'];

    // J'écris ma requête SQL
    $sql = "INSERT INTO `editeur` (`edit_nom`) values (:edit_nom)";

    // Je prépare ma requête
    $request = $pdo->prepare($sql);

    // J'injecte mes valeurs
    $request->bindValue(":edit_nom", $addEditor, PDO::PARAM_STR);

    // J'éxécute ma requête
    $request->execute();

    $modifBDDEditors = true;
    $idNewEditor = $pdo->lastInsertId();
}

if (isset($_POST['ean'])) {
    $gamePrice = trim($_POST['gamePrice']); // Je supprime les espaces et je rajoute le symbole euro
    $gamePrice = str_replace(",", ".", $_POST['gamePrice']); // Je remplace les "," par un "."
    $ean = trim($_POST['ean']); // Je supprime les espaces
    $gameTime = ($_POST['gameTime']); // Je supprime les espaces
    $createDate = str_replace("/", "-", $_POST['createDate']); // Je remplace les "/" par des "-"
    $noteGame = trim($_POST['noteGame']); // Je supprime les espaces
    $fileLink = trim($_POST['fileLink']); // Je supprime les espaces

    // Je récupère mes valeurs 
    $gameName = $_POST['gameName'];
    $descGame = $_POST['descGame'];
    $middleAge = $_POST['middleAge'];
    $gameTheme = $_POST['gameTheme'];
    $nbPlayer = $_POST['nbPlayer'] . " Joueurs";
    $author_ID = $_POST['author'];
    $editor_ID = $_POST['editor'];
    $country_ID = $_POST['country'];
    $languagesGame_ID = $_POST['languagesGame'];
    $category_ID = $_POST['category'];
    $mechanism_ID = $_POST['mechanism'];
    $stockGame = $_POST['stockGame'];

    if ($modifBDDEditors == true) { //Si l'utilisateur a écrit dans le champ ajouter un éditeur alors c'est celui-ci qui sera pris en compte 
        $editor_ID = $idNewEditor;
    }

    if ($modifBDDAuthors == true) {
        $author_ID = $idNewAuthor;
    }
    
    if ($modifBDDMechanism == true) {
        $mechanism_ID = $idNewMechanism;
    }
    if ($modifBDDTheme == true) {
        $gameTheme = $idNewTheme;
    }
    if ($modifBDDCategory == true) {
        $category_ID = $idNewCategory;
    }

    // // J'écris ma requête SQL
    $sql = "INSERT INTO `jeu` ( `jeu_nom`, `jeu_img`, `jeu_prix`, `jeu_EAN`, `jeu_dte_creation`, `jeu_nb_joueurs`, `jeu_description`, `jeu_temps`, `jeu_qte_stc`, `jeu_note`, `edit_id`, `pays_id`, `ctg_id`, `age_id`, `m_id`) VALUES (:jeu_nom, :jeu_img, :jeu_prix, :jeu_EAN, :jeu_dte_creation, :jeu_nb_joueurs, :jeu_description, :jeu_temps, :jeu_qte_stc, :jeu_note, :edit_id, :pays_id, :ctg_id, :age_id, :m_id)";

    // Je prépare ma requête
    $request = $pdo->prepare($sql);

    // J'injecte mes valeurs 
    $request->bindValue(":jeu_nom", $gameName, PDO::PARAM_STR);
    $request->bindValue(":jeu_img", $file_path);
    $request->bindValue(":jeu_EAN", $ean, PDO::PARAM_INT);
    $request->bindValue(":jeu_prix", $gamePrice);
    $request->bindValue(":jeu_dte_creation", $createDate);
    $request->bindValue(":jeu_nb_joueurs", $nbPlayer, PDO::PARAM_STR);
    $request->bindValue(":jeu_description", $descGame, PDO::PARAM_STR);
    $request->bindValue(":jeu_temps", $gameTime, PDO::PARAM_STR);
    $request->bindValue(":jeu_qte_stc", $stockGame, PDO::PARAM_INT);
    $request->bindValue(":jeu_note", $noteGame);
    $request->bindValue(":edit_id", $editor_ID, PDO::PARAM_INT);
    $request->bindValue(":pays_id", $country_ID, PDO::PARAM_INT);
    $request->bindValue(":ctg_id", $category_ID, PDO::PARAM_INT);
    $request->bindValue(":age_id", $middleAge, PDO::PARAM_INT);
    $request->bindValue(":m_id", $mechanism_ID, PDO::PARAM_INT);

    // J'éxécute ma requête
    $request->execute();

    $id_NewGame = $pdo->lastInsertId();

    // J'écris mes trois nouvelle requêtes pour les tables en relation avec ma table jeu
    $sql = "INSERT INTO `jeu_theme` (`jeu_id`, `tdj_id`) VALUES (:jeu_id, :tdj_id)";
    $sql2 = "INSERT INTO `jeu_langues` (`jeu_id`, `l_id`) VALUES (:jeu_id, :l_id)";
    $sql3 = "INSERT INTO `jeu_auteurs` (`jeu_id`, `a_id`) VALUES (:jeu_id, :a_id)";

    // Je prépare mes requêtes
    $request = $pdo->prepare($sql);
    $request2 = $pdo->prepare($sql2);
    $request3 = $pdo->prepare($sql3);

    // J'injecte mes valeurs 
    $request->bindValue(":jeu_id", $id_NewGame, PDO::PARAM_INT);
    $request->bindValue(":tdj_id", $gameTheme, PDO::PARAM_INT);

    $request2->bindValue(":jeu_id", $id_NewGame, PDO::PARAM_INT);
    $request2->bindValue(":l_id", $languagesGame_ID, PDO::PARAM_INT);

    $request3->bindValue(":jeu_id", $id_NewGame, PDO::PARAM_INT);
    $request3->bindValue(":a_id", $author_ID, PDO::PARAM_INT);

    // J'éxécute ma requête
    $request->execute();

    $request2->execute();

    $request3->execute();

    header ('location:./index.php');
}

?>
</main>

<?php include './includes/footer.php' ?>