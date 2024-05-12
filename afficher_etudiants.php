<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once './includes/header.inc.php';
include('./includes/side_profile.inc.php');

if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: ./login.php');
    exit; // Assurez-vous de terminer le script après la redirection
}

// code pour selecter tous les etudaint qui suivent les cours de prof
//sql code pour appliquer la requete
$sql = "select e.nom as nom, e.prenom as prenom, e.image as image, e.mail as mail, m.titre as titre from utilisateurs as e 
        join courssuivis as cs on e.id = cs.idEtudiant 
        join module as m on cs.idCours = m.id
        where m.proprietaire = ?;";

// Préparation de la requête
$stmt = $conn->prepare($sql);
$etudiants='';
if ($stmt) {
    // Paramètre du professeur a laid de session sto
    $professeur_id =$_SESSION['userID'];
    
    // Liaison des paramètres
    $stmt->bind_param("i", $professeur_id);


    // Exécution de la requête
    $stmt->execute();

    // Récupération des résultats
    $result = $stmt->get_result();
}
?>

<!-- Votre code HTML existant... -->

 <section class='home-grid'>
      <div class="sub-title">
          <div class="title-content">Etudiant suivent <span>mes cours</span></div>
      </div>
          
         <div style="display: flex; flex-direction: row;">
            <?php
                foreach ($result as $etudiant) 
                {
            ?>
                    <div class="identity profPop">
                        <center>
                            <img src="./users_images/<?= $etudiant['image'] ?>" class="image" alt="">
                            <h1 class="name"><?= $etudiant['nom'].' '.$etudiant['prenom']  ?></h1>
                            <h2 style="text-decoration: underline;"><?= $etudiant['mail'] ?></h2>

                            <span style="color: var(--main-color); font-size: 1.4rem;">
                                Cet étudiant suit le cours : 
                                <span style="font-size: 1.6rem;"><?= $etudiant['titre'] ?></span>
                            </span>
                        </center>
                    </div>
            <?php }?>
         </div>
 </section>

<!-- Votre code HTML existant... -->

<?php include 'foot.php'; ?>