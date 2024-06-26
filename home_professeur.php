 <?php
 //for connect
 include('./includes/connection.inc.php');
 include('./includes/fn.inc.php');
 require_once './includes/headerProf.inc.php';
 include('./includes/side_profile.inc.php');
 if(session_status() === PHP_SESSION_NONE) session_start(); 
 if(!$_SESSION['userID']){
   header('Location: login.php');
 }
 $userID=$_SESSION['userID'];
 if (isset($_POST['ajouter_course'])) {
 if(!empty($_POST['cour_name']) && !empty($_POST['cour_password'])){
   $cour_name=$_POST['cour_name'];
   $cour_password=$_POST['cour_password'];
   $courID=rand(10,1000);
   $user_id=$_SESSION['userID'];
   
   $sql="INSERT INTO module(courID, userID, name, password)
         VALUES('$courID', $user_id, '$cour_name', '$cour_password')";

   $query=mysqli_query($conn,$sql) ;
      if($query){
        echo 'cour a ete ajoute avec succes';
   }
   
 }
}
//ajouter module
if (isset($_POST['ajouter_module'])) {
    if (!empty($_POST['titre']) && !empty($_POST['Code_Cours'])) {
        $titre = $_POST['titre'];
        $presentation = $_POST['presentation'];
        $mots_cles = $_POST['mots_cles'];
        $cible = $_POST['cible'];
        $prerequis = $_POST['prerequis'];
        $code_cours = $_POST['Code_Cours'];
        $proprietaire = $_SESSION['userID'];
        $userID=$_SESSION['userID'];
        // Vérification de la visibilité progressive
        $est_progressif = isset($_POST['progressif']) && $_POST['progressif'] === 'progressif' ? 1 : 0;

        // Génération d'un ID de cours aléatoire (modifié pour éviter les doublons)
        $courID = uniqid();

        $sql = "INSERT INTO module(IdParent, titre, presentation, mots_cles, Code_Cours, cible, prerequis, est_progressif, proprietaire)
                VALUES($userID, '$titre', '$presentation', '$mots_cles', '$code_cours', '$cible', '$prerequis', $est_progressif, $proprietaire)";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo 'Le cours a été ajouté avec succès';
        } else {
            echo 'Erreur lors de l\'ajout du cours';
        }
    }
}

  //get all modules from db

    $sql_cours = "SELECT * FROM module WHERE IdParent = ?";

    $stmt = mysqli_prepare($conn, $sql_cours);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cours = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //suprimer un module
    if (isset($_POST['suprimer_module']) && $_SERVER["REQUEST_METHOD"] == "POST" ) {
        // Récupérer l'ID du module à supprimer
        $moduleID = $_POST['moduleID'];
    
        // Requête de suppression
        $requete = "DELETE FROM module WHERE id = ?";
    
        // Préparation de la requête
        $statement = $conn->prepare($requete);
    
        // Liaison des paramètres
        $statement->bind_param("i", $moduleID);
    
        // Exécution de la requête
        $resultat = $statement->execute();
    }    
    //ajouter un chapitre
    if (isset($_POST['ajouter_cousre_item'])) {
        if(!empty($_POST['chapitre_nom']) && !empty($_FILES['contenu']['name'])){
          $chapitre_content_nom=$_FILES['contenu']['name'];
          $chapitre_content_tmp=$_FILES['contenu']['tmp_name'];
          $module_nom=$_POST['module_nom'];
          $destination='./ressources_cours';
          $select_parent="SELECT * FROM module WHERE titre='$module_nom'";
          $query=mysqli_query($conn,$select_parent);
          $row=mysqli_fetch_object($query);
          $ParentID=$row->IdParent;
          $est_accessible=1;
          $sqlChapitre="INSERT INTO chapitre(IdModule, contenu, accessible) VALUES($ParentID, '$chapitre_content_nom','$est_accessible')";
       
          $query=mysqli_query($conn,$sqlChapitre) ;
             if($query){
                move_uploaded_file($chapitre_content_tmp,$destination.$chapitre_content_nom);
               echo 'cour item a ete ajoute avec succes';
          }
          
        }
       }
?>
<!-- head included in php file -->

<!-- //home grid -->
<section class="home-grid">
    <div class="statistics-container">
        <div class="statistics-content">
            <div class="statics-box">
                <div class="icon">
                <i class="ri-book-fill"></i>
                </div>
                <div class="static-name">
                   <a href="cours_de_professeur.php" class='btn main-btn'>mes cours</a>
                </div>
            </div>

            <div class="statics-box">
                <div class="icon">
                <i class="ri-graduation-cap-fill"></i>
                </div>
                
                <div class="static-text">
                <a href="afficher_etudiants.php" class='btn main-btn'>mes héritiers</a>
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

             <center><button type='submit' name='ajouter_module' class='btn main-btn'>ajouter</button><center>
         </form>
     </div>
     <div class="separator"></div>
     <div class="add-course-item">
        <div class="sub-title">
              <h4 class="title-content">Ajouter <span>cour composant</span></h4>
         </div>
         <form method="POST" class="myform" enctype="multipart/form-data">
             <div class="input-pass">
                 <input type="text" name='chapitre_nom' class="box" placeholder='Entrer le nom de chapitre...'>
             </div>    
             <div class="input-pass">
                 <input type="file" name='contenu' class="box" >
             </div>
             <div class="input-pass">
                 <input type="text" name='module_nom' class="box" placeholder='Entrer le nom de module...'>
             </div> 
             <button type='submit' name='ajouter_cousre_item' class='btn main-btn'>ajouter</button>
          </form>
     </div>
  </div>
  <div class="right-content">
     <table class='pro_table'>
        <thead>
           <tr>
             <th>id</th>
             <th>titre</th>
             <th>modifier</th>
             <th>suprimer</th>
           </tr>
        </thead>
        <tbody>
         <?php foreach ($cours as $cour ) { ?>
              <tr>
                   <td><?php echo $cour['id'] ?></td>
                   <td><?php echo $cour['titre'] ?></td>
                   <td><a href="modifier_cours.php?courID=<?php echo $cour['id'] ?>"><div class="table_icon modify"><i class="ri-loop-left-line"></i></div></a></td>
                   <td>
                    <form  method="post">
                    <input type="hidden" name="moduleID" value="<?php echo $cour['id'] ?>">
                    <button type="submit" name='suprimer_module'><div class="table_icon delete"><i class="ri-delete-bin-fill"></i></div></button>
                   </form>
                   </td>
              </tr>
           <?php }?>
        </tbody>
</section>
<?php  include 'foot.php' ?>