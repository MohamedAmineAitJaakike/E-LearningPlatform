<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once './includes/header.inc.php';
include('./includes/side_profile.inc.php');

// Récupération de tous les cours
$cours=array();
$userID = $_SESSION['userID'];
$moduleID=$_GET['moduleID'];
$sql = "SELECT * FROM chapitre WHERE IdModule= $moduleID";
$result = mysqli_query($conn, $sql);

if ($result) {
    $chapitres = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Further processing of the fetched data
} else {
    echo "Error: " . mysqli_error($conn); // Output the specific MySQL error
}
?>

<!-- Code HTML pour afficher tous les cours -->
<section class="all-courses">
    <div class="container">
        <h2 style="text-align: center; font-size: 55px; color:#fc8021;    border-radius: 11px;box-shadow:0 0 11px black ;margin:50px;margin-left:80px">les chapitres</h2>
        <div class="course-list">
            <?php foreach ($chapitres as $cahpitre) { ?>
            <div class="course-card">
                <img src="./logo/pdf_image.png" alt="">
            </div>
            <?php } ?>
        </div>
    </div>
</section>


<?php include 'foot.php'; ?>
