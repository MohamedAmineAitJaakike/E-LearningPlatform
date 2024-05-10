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
            module m ON cs.idCours = m.id
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

// code pour selecter tous les etudaint qui suivent les cours de prof
//sql code pour appliquer la requete
$sql = "SELECT u.nom, u.prenom, u.mail FROM utilisateurs u
        INNER JOIN courssuivis cs ON u.id = cs.idEtudiant
        INNER JOIN module m ON cs.idCours = m.id
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
