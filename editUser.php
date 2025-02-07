<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/header.php';

// Vérifier si l'utilisateur est connecté et est Admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    echo "<div class='container mt-4'><p class='alert alert-danger'>Accès refusé.</p></div>";
    include 'includes/footer.php';
    exit();
}



if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='container mt-4'><p class='alert alert-danger'>ID utilisateur manquant.</p></div>";
    include 'includes/footer.php';
    exit();
}

$u_id = intval($_GET['id']);

// Récupérer les informations de l'utilisateur
$query = "SELECT u.u_pseudo, u.u_email, c.clt_nom, c.clt_prenom, c.clt_adress, c.clt_cp, c.clt_ville, c.clt_numero_tel, tu.tu_id
          FROM utilisateurs u
          JOIN client c ON c.clt_id = u.u_id
          JOIN type_utilisateur tu ON u.tu_id = tu.tu_id
          WHERE u.u_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$u_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<div class='container mt-4'><p class='alert alert-danger'>Utilisateur introuvable.</p></div>";
    include 'includes/footer.php';
    exit();
}

// Récupérer les rôles pour la liste déroulante
$typeQuery = "SELECT tu_id, tu_libelle FROM type_utilisateur";
$typeStmt = $pdo->query($typeQuery);
$roles = $typeStmt->fetchAll(PDO::FETCH_ASSOC);

// Mise à jour des informations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $telephone = $_POST['telephone'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE utilisateurs u 
                    JOIN client c ON c.clt_id = u.u_id
                    SET u.u_pseudo = ?, u.u_email = ?, c.clt_nom = ?, c.clt_prenom = ?, 
                        c.clt_adress = ?, c.clt_cp = ?, c.clt_ville = ?, c.clt_numero_tel = ?, u.tu_id = ?
                    WHERE u.u_id = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([$pseudo, $email, $nom, $prenom, $adresse, $code_postal, $ville, $telephone, $role, $u_id]);

    echo "<div class='container mt-4'><p class='alert alert-success'>Utilisateur mis à jour avec succès.</p></div>";

    echo '<meta http-equiv="refresh" content="0;url=admin.php">'; // Redirection vers la page d'administration
    exit();
}
?>

<main> 
    <div class="container mt-4"> 
        <h2>Modifier l'utilisateur</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= htmlspecialchars($user['u_pseudo']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['u_email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($user['clt_nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($user['clt_prenom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="<?= htmlspecialchars($user['clt_adress']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Code Potal</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal" value="<?= htmlspecialchars($user['clt_cp']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" value="<?= htmlspecialchars($user['clt_ville']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($user['clt_numero_tel']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select class="form-control" id="role" name="role" required>
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['tu_id'] ?>" <?= $role['tu_id'] == $user['tu_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($role['tu_libelle']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form> 
    </div>
   
</main>

<?php include 'includes/footer.php'; ?>
