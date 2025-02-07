<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/header.php';

// Vérifier si l'utilisateur est connecté et est Admin
if (!isset($_SESSION['user_id']) && $_SESSION['user_type'] !== 'Admin') {
    echo "<div class='container mt-4'><p class='alert alert-danger'>Accès refusé : Vous devez être Admin pour accéder à cette page.</p></div>";
    include 'includes/footer.php';
    exit();
}

?>

<main>
    <div class="container mt-4">

    <h2>Gestion des utilisateurs</h2>

    <?php
    // Vérifier si la connexion PDO fonctionne
    if (!$pdo) {
        die("Erreur de connexion à la base de données !");
    }

    // Récupérer la liste des utilisateurs et leurs informations
    $query = "SELECT 
                clt_nom, clt_prenom, clt_adress, clt_numero_tel, 
                u.u_id, u.u_pseudo, u.u_email, tu.tu_libelle 
              FROM 
                utilisateurs u
              JOIN 
                type_utilisateur tu ON u.tu_id = tu.tu_id
              JOIN 
                client c ON u.u_id = c.u_id";
    
    $stmt = $pdo->query($query);

    if (!$stmt) {
        die("Erreur dans la requête SQL.");
    }

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    if (empty($users)) {
        echo "<p class='alert alert-warning'>Aucun utilisateur trouvé.</p>";
    } else {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nom</th><th>Prénom</th><th>Adresse</th><th>Téléphone</th><th>Pseudo</th><th>Email</th><th>Rôle</th><th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($users as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['clt_nom']) . '</td>';
            echo '<td>' . htmlspecialchars($row['clt_prenom']) . '</td>';
            echo '<td>' . htmlspecialchars($row['clt_adress']) . '</td>';
            echo '<td>' . htmlspecialchars($row['clt_numero_tel']) . '</td>';
            echo '<td>' . htmlspecialchars($row['u_pseudo']) . '</td>';
            echo '<td>' . htmlspecialchars($row['u_email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['tu_libelle']) . '</td>';
            
            echo '<td>';
            echo '<a href="editUser.php?id=' . $row['u_id'] . '" class="btn btn-warning btn-sm">Modifier</a> ';
            echo '<a href="deleteUser.php?id=' . $row['u_id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\');">Supprimer</a>';
            echo '</td>';
            
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }
    ?>
</div>
</main>

<?php include 'includes/footer.php'; ?>
