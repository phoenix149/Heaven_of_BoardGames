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

// Vérifier si l'utilisateur existe
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='container mt-4'><p class='alert alert-danger'>ID utilisateur manquant.</p></div>";
    include 'includes/footer.php';
    exit();
}

$u_id = intval($_GET['id']);

// Supprimer l'utilisateur
$deleteQuery = "DELETE FROM utilisateurs WHERE u_id = ?";
$deleteStmt = $pdo->prepare($deleteQuery);
$deleteStmt->execute([$u_id]);

echo "<div class='container mt-4'><p class='alert alert-success'>Utilisateur supprimé avec succès.</p></div>";

echo '<meta http-equiv="refresh" content="0;url=admin.php">'; // Redirection vers la page d'administration
include 'includes/footer.php';
?>
