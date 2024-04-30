<?php
include_once './includes/connection.inc.php';
include_once './includes/fn.inc.php';
require_once './includes/header.inc.php';
include_once './includes/side_profile.inc.php';

if(session_status() === PHP_SESSION_NONE) session_start(); 
if(!$_SESSION['userID']){
    header('Location: login.php');
}

// Récupérer les cours depuis la base de données
$sql = "SELECT module.titre AS titre_cours, utilisateurs.nom AS nom_proprietaire
FROM courssuivis
JOIN module ON courssuivis.idCours = module.IdParent
JOIN utilisateurs ON module.proprietaire = utilisateurs.id
WHERE courssuivis.idEtudiant = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["id"]);
$stmt->execute();
$result = $stmt->get_result();
$cours = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Mettez ici vos balises meta et titre -->
   <style>
      .sub-title {
         display: flex;
         justify-content: space-between;
         align-items: center;
      }
   </style>
</head>
<body>
<section class="home-grid">
    <div class="sub-title">
        <h4 class='title-content'>Mes <span>cours</span></h4>
        
        <!-- Bouton pour afficher tous les cours -->
        <a href="afficher_tous_cours.php" class="btn main-btn">Afficher tous les cours</a>
    </div>
    <?php if (!empty($cours)) { ?>
        <?php foreach ($cours as $cour) {?>
            <div class="box">
                <div class="course-item">
                     <!-- Si vous avez une image de cours, remplacez le chemin src -->
                     <div class="course-item-image">
                          <img src="./images/pic-1.jpg" width='100' alt="">
                     </div>
                     <div class="course-item-text">
                         <div class="cour-infos">
                             <div class="cour-nom">
                                 <h4><?php echo $cour['titre'] ?></h4>
                             </div>
                             <div class="btn-incri">
                                 <button>inscrire</button>
                             </div>
                         </div>
                         <div class="cour-prof">
                            <h4 class="prof-nom">Nom du professeur</h4>
                         </div>
                     </div>
                  </div>
                  <div class="inscription-box">
                     <div class="icon">
                         <i class="fa-regular fa-circle-xmark"></i>
                     </div>
                      <div class="pass-box">
                        <!-- Ici vous pouvez mettre des informations supplémentaires sur le cours -->
                      </div>
                  </div>
            </div>
        <?php }?>
    <?php } else { ?>
        <div class="sub-title"><center><p class='title-content'>Pas de cours disponibles pour le moment.</p></center></div>
    <?php } ?>
</section>
</body>
</html>
