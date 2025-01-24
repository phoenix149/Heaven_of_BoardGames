
<?php include './includes/header.php';?>

<?php


// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['u_id'])) {
    header('Location: index.php'); // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
    exit();
}

// Traitement de la soumission du formulaire de connexion
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire en méthode POST
    $login = htmlspecialchars(trim($_POST['login']));
    $password = htmlentities(trim($_POST['password']));



    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo=:u_pseudo;");
    $stmt->bindValue(':u_pseudo', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['u_mdp'])) {
        // Connexion réussie, stockage de l'identifiant de l'utilisateur dans la variable de session
        $_SESSION['u_id'] = $user['u_id'];

        //recup le type d'utilisateur pour renseigner la variable de session user_type
        $stmt = $pdo->prepare("SELECT * FROM type_utilisateur WHERE tu_id=tu_id");
        $stmt->bindValue(':tu_id', $user['tu_id']);
        $stmt->execute();
        $usert = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_type'] = $usert['tu_libelle'];
        $_SESSION['logged_in'] = true;
        header('Location: index.php'); // Redirection vers la page d'accueil
        exit();
    } else {
        // Identifiants incorrects, affichage d'un message d'erreur
        $error_message = "Email ou mot de passe incorrect.";
    }
}
?>


    <main>


        <?php if (isset($error_message)) : ?>
            <p><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <p>Veuillez vous connectez pour voir les jeux</p>
        <p>Pas de compte ? <a href="inscription.php">S'inscrire</a></p>
        <form method="post">
            <div>
                <label for="login">Identifiant</label>
                <input type="text" name="login" required>
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <input type="submit" name="connexion" value="Connexion">
            </div>
            <a href="#">Mot de passe oublié ?</a>
        </form>
    </main>

    <?php include './includes/footer.php'; ?>
 