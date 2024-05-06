<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once './includes/header.inc.php';
include('./includes/side_profile.inc.php');

// Récupération de tous les cours
$sql = "SELECT * FROM module";
$result = mysqli_query($conn, $sql);
$cours = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Code HTML pour afficher tous les cours -->
<section class="all-courses">
    <div class="container">
        <h2 style="text-align: center; font-size: 80px; color:#fc8021; box-shadow:0 0 11px black ;margin:50px;margin-left:80px">Tous les cours</h2>
        <div class="course-list">
            <?php foreach ($cours as $cour) { ?>
            <div class="course-card">
                <h3 class="course-title"><?php echo $cour['titre']; ?></h3>
                <p class="course-details">
                    <strong>Mots clés :</strong> <?php echo $cour['mots_cles']; ?><br>
                    <strong>Code du cours :</strong> <?php echo $cour['Code_Cours']; ?><br>
                    <strong>Cible :</strong> <?php echo $cour['cible']; ?><br>
                    <strong>Prérequis :</strong> <?php echo $cour['prerequis']; ?><br>
                    <strong>Propriétaire :</strong> <?php echo $cour['proprietaire']; ?><br>
                    <strong>Progressif :</strong> <?php echo $cour['est_progressif'] ? 'Oui' : 'Non'; ?>
                </p>
            </div>
            <?php } ?>
        </div>
    </div>
</section>


<?php include 'foot.php'; ?>
