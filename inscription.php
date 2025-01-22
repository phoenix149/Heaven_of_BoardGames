
<?php // Configuration de la base de données
// Traitement de la soumission du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire en méthode POST
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE u_pseudo=:u_pseudo");
    $stmt->bindValue(':u_pseudo', $pseudo);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        // L'utilisateur existe déjà, affichage d'un message d'erreur
        $error_message = "Ce login est déjà utilisé par un autre utilisateur.";
    } else {
        // Insertion de l'utilisateur dans la base de données
        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hashage du mot de passe
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (u_pseudo, u_email, u_mdp, tu_id)
        VALUES (:u_pseudo, :email, :mot_de_passe, 2)"); //on force le type utilisateur à client
        $stmt->bindValue(':u_pseudo', $pseudo);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':mot_de_passe', $password_hash);

        $stmt->execute();        // Récupération de l'identifiant de l'utilisateur inséré

        $user_id = $pdo->lastInsertId();        // Connexion automatique de l'utilisateur après son inscription

        $_SESSION['utilisateur_ID'] = $user_id;

        header('Location: index.php'); // Redirection vers la page d'accueil
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Inscription</title>
</head>

<?php
session_start();
include './includes/header.php';
?>



<body>

    <main>
        <h1>Créer un compte</h1>
        <p>Veuillez remplir les champs suivants :</p>

        <form method="post">
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" required>
            </div>
            <div>
                <label for="pseudo">Pseudo (optionnel)</label>
                <input type="text" name="pseudo">
            </div>
            <div>
                <label for="date_naissance">Date de naissance</label>
                <input type="date" name="date_naissance" required>
            </div>
            <div>
                <p>Adresse</p>
                <label for="numero_rue">N° de rue</label>
                <input type="number" name="numero_rue" required>
            </div>
            <div>
                <label for="nom_rue">Nom de rue</label>
                <input type="text" name="nom_rue" required>
            </div>
            <div>
                <label for="complement_adresse">Complément d'adresse</label>
                <input type="text" name="complement_adresse">
            </div>
            <div>
                <label for="code_postal">Code postal</label>
                <input type="number" name="code_postal" required>
            </div>
            <div>
                <label for="ville">Ville</label>
                <input type="text" name="ville" required>
            </div>
            <div>
                <label for="telephone">N° de téléphone</label>
                <input type="tel" name="telephone" required>
            </div>
            <div>
                <label for="email">Mail</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="password">Créer un mot de passe</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label for="password_confirm">Confirmer mot de passe</label>
                <input type="password" name="password_confirm" required>
            </div>
            <div>
                <input type="submit" value="Confirmer">
                <input type="reset" value="Annuler">
            </div>
        </form>
        <p>Déjà inscrit ? <a href="connexion.php">Se connecter</a></p>
    </main>

    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>

</html>