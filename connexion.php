

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectez-vous!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

<?php
session_start(); 
include './includes/header.php';
?>
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
?>


    <main>

    <?php  
// Vérification si l'utilisateur est déjà connecté
if (isset($_SESSION['u_id'])) {
	header('Location: index.php'); // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
	exit();
}

// Traitement de la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Récupération des données du formulaire en méthode POST
	$login = htmlspecialchars(trim($_POST['login']));
    $password = trim($_POST['password']);



    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo=:login;");
    $stmt->bindValue(':login', $login);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user && isset($user['tu_id']) && password_verify($password, $user['mdp'])) {
        // Connexion réussie, stockage de l'identifiant de l'utilisateur dans la variable de session
        $_SESSION['user_id'] = $user['u_id'];
    
        //recup le type d'utilisateur pour renseigner la variable de session user_type
        $stmt = $pdo->prepare("SELECT * FROM type_utilisateur WHERE tu_id=:typeuser");
        $stmt->bindValue(':typeuser', $user['tu_id']);
        $stmt->execute();
        $usert = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_type'] = $usert['Libelle'];
        $_SESSION['logged_in'] = true;
        header('Location: index.php'); // Redirection vers la page d'accueil
        exit();
    } else {
        // Identifiants incorrects, affichage d'un message d'erreur
        $error_message = "Email ou mot de passe incorrect.";
    }
    
}
?>

    <h1>Bienvenue sur Heaven of BoardGames</h1>
    <?php if (isset($error_message)) : ?>
	<p><?php echo $error_message; ?></p>
<?php endif; ?>
    <p>Veuillez vous connectez pour voir les jeux</p>
    <p>Pas de compte ? <a href="inscription.php">S'inscrire</a></p>
        <form action="#" method="post">
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

<?php include './includes/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>