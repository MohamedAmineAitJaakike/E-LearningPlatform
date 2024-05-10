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

// code pour selecter tous les etudaint qui suivent les cours de prof
//sql code pour appliquer la requete
$sql = "SELECT u.nom, u.prenom, u.mail FROM utilisateurs u
        INNER JOIN courssuivis cs ON u.id = cs.idEtudiant
        INNER JOIN module m ON cs.idCours = m.IdParent
        WHERE m.proprietaire = ?";

// Préparation de la requête
$stmt = $conn->prepare($sql);
$etudiants='';
if ($stmt) {
    // Liaison des paramètres
    $stmt->bind_param("i", $professeur_id);

    // Paramètre du professeur a laid de session sto
    $professeur_id =$_SESSION['user'];

    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $result = $stmt->get_result();

    // Vérification s'il y a des résultats
    if ($result->num_rows > 0) {
        // Affichage des résultats
        while ($row = $result->fetch_assoc()) {
          $etudiants.= `
              <div class="course-item">
                <div class="course-item-image">
                   <img src="./users_images/`.$etudiant['image'].`" width='100' alt="">
                </div>
                <div class="course-item-text">
                  <div cla              ss="cour-infos">
                      <div class="cour-nom">
                          <h4>`.$cour[0].`</h4>
                      </div>
                      <div class="btn-incri">
                          <button>inscrire</button>
                      </div>
                  </div>
                  <div class="cour-prof">
                     <h4 class="prof-nom">pr.jourani</h4>
                  </div>
                  </div>
             </div>
           `;
        }
    } else {
        echo $etus="Aucun étudiant suivi votre cours.";
    }
}
?>

<!-- Votre code HTML existant... -->

 <section class='home-grid'>
      <div class="sub-title">
          <div class="title-content">Etudiant suivent <span>mes cours</span></div>
      </div>
          
         <div class="home-grid">
              <?php echo $etudiants ?>
         </div>
 </section>

<!-- Votre code HTML existant... -->

<?php include 'foot.php'; ?>
