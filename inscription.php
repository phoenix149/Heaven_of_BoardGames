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

    <?php include 'includes/header.php'; ?>

    <?php

    // Vérification si l'utilisateur est déjà connecté
    if (isset($_SESSION['u_id'])) {
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
        // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
        exit();
    }

    // Traitement de la soumission du formulaire d'inscription
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données du formulaire en méthode POST
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $adresse = htmlentities($_POST['adresse'] ?? '');
        $code_postal = $_POST['code_postal'];
        $ville = htmlentities($_POST['ville']);
        $telephone = $_POST['telephone'];
        $pseudo = htmlentities($_POST['pseudo']);
        $email = htmlentities($_POST['email']);
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        // Vérification que les mots de passe correspondent
        if ($password !== $password_confirm) {
            echo "<p style='color:red;'>Les mots de passe ne correspondent pas.</p>";
            exit();
        }

        // Vérifier si le pseudo ou l'email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo = :pseudo OR u_email = :email");
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            echo "<p style='color:red;'>Le pseudo ou l'email est déjà utilisé.</p>";
            exit();
        }

        // Hashage du mot de passe
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertion dans la table utilisateurs
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (u_pseudo, u_email, u_mdp, tu_id) VALUES (:pseudo, :email, :password, 2)");
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password_hash);
        $stmt->execute();

        // Récupération de l'identifiant de l'utilisateur inséré
        $user_id = $pdo->lastInsertId();

        // Vérification si le client existe déjà
        $stmt = $pdo->prepare("SELECT * FROM client WHERE clt_nom = :nom AND clt_prenom = :prenom AND clt_numero_tel = :telephone");
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':telephone', $telephone);
        $stmt->execute();
        $existing_client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_client) {
            echo "<p style='color:red;'>Le client existe déjà avec ce numéro de téléphone.</p>";
            exit();
        }

        // Insertion dans la table client
        $stmt = $pdo->prepare("INSERT INTO client (clt_nom, clt_prenom, clt_adress, clt_cp, clt_ville, clt_numero_tel, u_id) 
         VALUES (:nom, :prenom, :adresse, :code_postal, :ville, :telephone, :user_id)");
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':adresse', $adresse);
        $stmt->bindValue(':code_postal', $code_postal);
        $stmt->bindValue(':ville', $ville);
        $stmt->bindValue(':telephone', $telephone);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->execute();

        $_SESSION['message'] = "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter.";
        echo '<meta http-equiv="refresh" content="0;url=connexion.php">'; // Redirection vers la page d'accueil
        exit();
    }
    ?>

    <main>
        
        <form method="post" class="msForms">
            <h1>Créer un compte</h1>
            <p>Veuillez remplir les champs suivants :</p>
            <div>
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div>
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
            <div>
                <label for="pseudo" class="form-label">Pseudo </label>
                <input type="text" name="pseudo" class="form-control" required>
            </div>
            <div>
                <label for="complement_adresse" class="form-label">Adresse</label>
                <input type="text" name="Adresse" class="form-control">
            </div>
            <div>
                <label for="code_postal" class="form-label">Code postal</label>
                <input type="number" name="code_postal" required class="form-control">
            </div>
            <div>
                <label for="ville" class="form-label">Ville</label>
                <input type="text" name="ville" required class="form-control">
            </div>
            <div>
                <label for="telephone" class="form-label">N° de téléphone</label>
                <input type="tel" name="telephone" required class="form-control">
            </div>
            <div>
                <label for="email" class="form-label">Mail</label>
                <input type="email" name="email" required class="form-control">
            </div>
            <div>
                <label for="password" class="form-label">Créer un mot de passe</label>
                <input type="password" name="password" required class="form-control">
            </div>
            <div>
                <label for="password_confirm" class="form-label">Confirmer mot de passe</label>
                <input type="password" name="password_confirm" required class="form-control">
            </div>
            <div>
                <input type="submit" class="btn btn-secondary" value="Confirmer">
                <input type="reset" value="Annuler" class="btn btn-secondary">
            </div>
            <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
        </form>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>