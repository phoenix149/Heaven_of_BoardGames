<?php


// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation des données
    $pseudo = $_POST['pseudo'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validation des champs obligatoires
    if (empty($pseudo) ||empty($email) || empty($password) || empty($password_confirm)) {
        $_SESSION['error_message'] = htmlspecialchars("Veuillez remplir tous les champs obligatoires.");
        header("Location: inscription.php");
        exit();
    } elseif ($password !== $password_confirm) {
        $_SESSION['error_message'] = htmlspecialchars("Les mots de passe ne correspondent pas.");
        header("Location: inscription.php");
        exit();
    } else {
        // Vérifier si le pseudo ou l'email existe déjà
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo = :pseudo OR u_email = :email");
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            $_SESSION['error_message'] = htmlspecialchars("Le pseudo ou l'email est déjà utilisé.");
            header("Location: inscription.php");
            exit();
        } else {
            // Hashage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (u_pseudo, u_email, u_mdp, tu_id) VALUES (:pseudo, :email, :password, 2)");  //on force le type utilisateur à client
            $stmt->bindValue(':pseudo', $pseudo);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $hashed_password);
            $stmt->execute();

            // Récupération de l'identifiant de l'utilisateur inséré
            $user_id = $pdo->lastInsertId();

            // Connexion automatique de l'utilisateur après son inscription
            $_SESSION['user_id'] = $user_id;

            // Succès
            header("Location: index.php");
            exit();
        }
    }
}
