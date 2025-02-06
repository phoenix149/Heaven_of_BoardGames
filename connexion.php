<?php
session_start(); // Démarrer la session
include './includes/header.php';
// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['u_id'])) {
    header('Location: index.php'); // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
    exit();
}
// Traitement de la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire en méthode POST
    $login = htmlspecialchars(trim($_POST['login']));
    var_dump('$login');
    $password = htmlentities(trim($_POST['password']));
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo=:u_pseudo;");
    $stmt->bindValue(':u_pseudo', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($user); 
    if ($user) {
        // Connexion réussie, stockage de l'identifiant de l'utilisateur dans la variable de session
        $_SESSION['user_id'] = $user['u_id']; // Définir user_id dans la session
        $_SESSION['tu_libelle'] = $user['tu_libelle'];

        //recup le type d'utilisateur pour renseigner la variable de session user_type
        $stmt = $pdo->prepare("SELECT * FROM type_utilisateur WHERE tu_id=:typeuser");
        $stmt->bindValue(':typeuser', $user['tu_id']);
        $stmt->execute();
        $usert = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['tu_libelle'] = $usert['tu_libelle'];
        $_SESSION['logged_in'] = true;
        var_dump($_SESSION);
        header('Location: index.php'); // Redirection vers la page d'accueil
       
        exit();

    } else {
        // Identifiants incorrects, affichage d'un message d'erreur
        $error_message = "Pseudo ou mot de passe incorrect.";
    }
}
?>
<main>
    <?php if (isset($error_message)) : ?>
        <p><?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <h5>Connectez-vous pour passer commande</h5>
    <p>Pas de compte ? <a href="inscription.php">S'inscrire</a></p>
    <form id="mSForms" method="post">
        <div>
            <label for="login" class="form-label">Identifiant</label>
            <input type="text" name="login" required class="form-control">
        </div>
        <div>
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" name="password" required class="form-control">
        </div>
        <div>
            <input type="submit" name="connexion" value="Connexion" class="btn btn-secondary">
        </div>
        <a href="#">Mot de passe oublié ?</a>
    </form>
</main>
<?php include './includes/footer.php' ?>