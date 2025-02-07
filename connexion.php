<?php include 'includes/header.php'; ?>


<?php


// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['u_id'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php">'; // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
    exit();
}

// Traitement de la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire en méthode POST
    $login = htmlspecialchars(trim($_POST['login']));
    $password = htmlentities(trim($_POST['password']));



    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo=:u_pseudo;");
    $stmt->bindValue(':u_pseudo', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['u_mdp'])) {
        // Connexion réussie, stockage de l'identifiant de l'utilisateur dans la variable de session
        $_SESSION['user_id'] = $user['u_id'];

        //recup le type d'utilisateur pour renseigner la variable de session user_type
        $stmt = $pdo->prepare("SELECT * FROM type_utilisateur WHERE tu_id=:typeuser");
        $stmt->bindValue(':typeuser', $user['tu_id']);
        $stmt->execute();
        $usert = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_type'] = $usert['tu_libelle'];
        $_SESSION['logged_in'] = true;
        echo '<meta http-equiv="refresh" content="0;url=index.php">'; // Redirection vers la page d'accueil
        exit();
    } else {
        // Identifiants incorrects, affichage d'un message d'erreur
        $error_message = "Pseudo ou mot de passe incorrect.";
    }
}
?>


<main>
    <?php
    if(!empty($_SESSION['message'])){
        echo '<div class="alert alert-success" role="alert">'. $_SESSION['message'].'</div>';
        $_SESSION['message'] = "";
    }
?>

    <?php if (isset($error_message)) : ?>
        <p><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form id="mSForms" method="post" class="msForms">
        <h5>Connectez-vous pour passer commande</h5>
        <p>Pas de compte ? <a href="inscription.php">S'inscrire</a></p>
        <div>
            <label for="login" class="form-label">Identifiant</label>
            <input type="text" name="login" required class="form-control">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div>
            <input type="submit" name="connexion" value="Connexion" class="btn btn-secondary">
        </div>
        <a href="#">Mot de passe oublié ?</a>
    </form>
</main>


<?php include 'includes/footer.php'; ?>