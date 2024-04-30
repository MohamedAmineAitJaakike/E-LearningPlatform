<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once './includes/header.inc.php';
include('./includes/side_profile.inc.php');

if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit; // Assurez-vous de terminer le script après la redirection
}

// Traitement du formulaire d'affichage des étudiants
if (isset($_POST['afficher_etudiants'])) {
    // Afficher les étudiants qui suivent chaque cours
    $query = "
        SELECT 
            m.titre AS titre_cours,
            GROUP_CONCAT(u.nom, ' ', u.prenom) AS etudiants
        FROM 
            utilisateurs u
        JOIN 
            courssuivis cs ON u.id = cs.idEtudiant
        JOIN 
            module m ON cs.idCours = m.IdParent
        WHERE 
            u.role = 'etudiant'
        GROUP BY 
            m.titre
        ORDER BY 
            m.titre;
    ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Étudiants par cours :</h2>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h3>{$row['titre_cours']}</h3>";
            echo "<p>{$row['etudiants']}</p>";
        }
    } else {
        echo "<p>Aucun étudiant trouvé.</p>";
    }
}

// Le reste de votre code existant...
?>

<!-- Votre code HTML existant... -->

<form method="POST" class="myform">
    <!-- Ajout d'un bouton pour afficher les étudiants -->
    <button type="submit" name="afficher_etudiants" class="btn main-btn">Afficher les étudiants</button>
</form>

<!-- Votre code HTML existant... -->

<?php include 'foot.php'; ?>
