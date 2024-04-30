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

// Traitement du formulaire d'ajout de cours
if (isset($_POST['ajouter_course'])) {
    if (!empty($_POST['titre']) && !empty($_POST['Code_Cours'])) {
        $titre = $_POST['titre'];
        $presentation = $_POST['presentation'];
        $mots_cles = $_POST['mots_cles'];
        $cible = $_POST['cible'];
        $prerequis = $_POST['prerequis'];
        $code_cours = $_POST['Code_Cours'];
        $proprietaire = $_SESSION['userID'];

        // Vérification de la visibilité progressive
        $est_progressif = isset($_POST['progressif']) && $_POST['progressif'] === 'progressif' ? 1 : 0;

        // Génération d'un ID de cours aléatoire (modifié pour éviter les doublons)
        $courID = uniqid();

        $sql = "INSERT INTO module(IdParent, titre, presentation, mots_cles, Code_Cours, cible, prerequis, est_progressif, proprietaire)
                VALUES(NULL, '$titre', '$presentation', '$mots_cles', '$code_cours', '$cible', '$prerequis', $est_progressif, $proprietaire)";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo 'Le cours a été ajouté avec succès';
        } else {
            echo 'Erreur lors de l\'ajout du cours';
        }
    }
}

// Traitement du formulaire d'ajout de composants de cours
if (isset($_POST['ajouter_cousre_item'])) {
    if (!empty($_POST['item_name']) && !empty($_FILES['item_content']['name']) && !empty($_POST['parent_name'])) {
        $cour_item_name = $_POST['item_name'];
        $cour_item_content = $_FILES['item_content']['name'];
        $courParentName = $_POST['parent_name'];

        // Génération d'un ID de composant de cours aléatoire (modifié pour éviter les doublons)
        $cour_itemID = uniqid();

        // Récupération de l'ID parent du cours à partir du nom du cours
        $select_parent = "SELECT * FROM module WHERE titre='$courParentName'";
        $query = mysqli_query($conn, $select_parent);
        $row = mysqli_fetch_object($query);
        $courParentID = $row->id;

        $sql = "INSERT INTO chapitre(IdModule, contenu)
                VALUES($courParentID, '$cour_item_name')";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo 'Le composant de cours a été ajouté avec succès';
        } else {
            echo 'Erreur lors de l\'ajout du composant de cours';
        }
    }
}

// Supprimer le cours
if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['courID'])) {
    $courID = $_GET['courID'];
    $sql = "DELETE FROM module WHERE id = $courID";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo 'Le cours a été supprimé avec succès';
    } else {
        echo 'Erreur lors de la suppression du cours';
    }
}

// Récupération de tous les cours de l'utilisateur
$userID = $_SESSION['userID'];
$sql_cours = "SELECT * FROM module WHERE proprietaire = ?";
$stmt = mysqli_prepare($conn, $sql_cours);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$cours = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- HTML pour afficher les cours et les formulaires d'ajout -->

<?php include 'foot.php'; ?>

<!-- head included in php file -->

<!-- //home grid -->
<section class="home-grid">
    <div class="statistics-container">
        <div class="statistics-content">
            <div class="statics-box">
                <div class="icon">
                    <i class="ri-graduation-cap-fill"></i>
                </div>
                <div class="static-name">
                    <h4>cours</h4>
                    <p class="static-value">+13</p>
                </div>
            </div>

            <div class="statics-box">
                <div class="icon">
                    <i class="ri-graduation-cap-fill"></i>
                </div>
                <div class="static-text">
                    <h4 class='static-name'>cours</h4>
                    <p class="static-value">+13</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class='prof-dahboard'>
    <div class="left-content">
        <div class="add-course">
            <div class="sub-title">
                <h4 class="title-content">Ajouter <span>cour</span></h4>
            </div>
            <form method="POST" class="myform">
                <div class="input-pass">
                    <input type="text" name='titre' class="box" placeholder='Intitule du cours...'>
                </div>
                <div class="input-pass">
                    <input type="text" name='presentation' class="box" placeholder='Presentation du cours...'>
                </div>
                <div class="input-pass">
                    <input type="text" name='mots_cles' class="box" placeholder='Mots cles se rapportant au cours...'>
                </div>
                <div class="input-pass">
                    <input type="text" name='cible' class="box" placeholder='Public vise...'>
                </div>
                <div class="input-pass">
                    <input type="text" name='prerequis' class="box" placeholder='Prerequis...'>
                </div>
                <div class="input-pass">
                    <input type="text" name='Code_Cours' class="box" placeholder='Entrez le mot de pass du cours...'>
                </div>
                <div class="input-pass" style="display: flex; flex-direction: row;column-gap:30%;margin-left:15%;">
                    <div style="display: flex; align-items: center;">
                        <label style="margin-right: 5px;"><input type="radio" name="progressif" value="progressif" style="transform: scale(0.4); margin-right: 5px;"> Visibilité Progressive</label>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <label style="margin-right: 5px;"><input type="radio" name="progressif" value="non_progressif" style="transform: scale(0.4); margin-right: 5px;"> Visibilité Non Progressive</label>
                    </div>
                </div>

                <center><button type='submit' name='ajouter_course' class='btn main-btn'>ajouter</button><center>
                        </form>
                </div>
                <div class="separator"></div>
                <div class="add-course-item">
                    <div class="sub-title">
                        <h4 class="title-content">Ajouter <span>cour composant</span></h4>
                    </div>
                    <form method="POST" class="myform" enctype="multipart/form-data">
                        <div class="input-pass">
                            <input type="text" name='item_name' class="box" placeholder='Entrer le nom de cour...'>
                        </div>
                        <div class="input-pass">
                            <input type="file" name='item_content' class="box">
                        </div>
                        <div class="input-pass">
                            <input type="text" name='parent_name' class="box" placeholder='Entrer le nom de cour...'>
                        </div>
                        <button type='submit' name='ajouter_cousre_item' class='btn main-btn'>ajouter</button>
                    </form>
                </div>
            </div>
            <div class="right-content">
                <!-- Bouton pour afficher les étudiants -->
                <a href="afficher_etudiants.php" class="btn main-btn">Afficher les étudiants</a>
                
                <!-- Bouton pour la gestion du profil des profs -->
                <a href="gestion_profil.php" class="btn main-btn">Gestion de profil</a>

                <!-- Tableau pour afficher les cours -->
                <table class='pro_table'>
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>nom</th>
                            <th>visiter</th>
                            <th>modifier</th>
                            <th>suprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cours as $cour) { ?>
                            <tr>
                                <td><?php echo $cour['id'] ?></td>
                                <td><?php echo $cour['titre'] ?></td>
                                <td><a href="cour_details.php?courID=<?php echo $cour['id'] ?>"><div class="table_icon visit"><i class="ri-eye-fill"></i></div></a></td>
                                <td><a href="modifier_cours.php?courID=<?php echo $cour['id'] ?>"><div class="table_icon modify"><i class="ri-loop-left-line"></i></div></a></td>
                                <td><a href="home_professeur.php?action=supprimer&courID=<?php echo $cour['id'] ?>"><div class="table_icon delete"><i class="ri-delete-bin-fill"></i></div></a></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </section>
        <?php include 'foot.php' ?>
