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

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Validation des mots de passe
    if ($password !== $password_confirm) {
        $error_message = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si le pseudo ou l'e-mail existe déjà
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo = :pseudo OR u_email = :email");
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            $error_message = "Le pseudo ou l'e-mail est déjà utilisé.";
        } else {
            // Hashage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (u_pseudo, u_email, u_mdp, tu_id) VALUES (:pseudo, :email, :password, 1)");
            $stmt->bindValue(':pseudo', $pseudo);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $hashed_password);
            $stmt->execute();

            // Succès
            header("Location: success_page.php");
            exit();
        }
    }
}
?>