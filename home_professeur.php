 <?php
 //for connect
 include('./includes/fn.inc.php');
 include('./includes/connection.inc.php');
 require_once'./includes/header.inc.php';
 include('./includes/side_profile.inc.php');

 if(session_status() === PHP_SESSION_NONE) session_start(); 

 //vérifie la session si c'est vraiment un user (prof ou etudiant) et rediriger vers login
 $condition = !$_SESSION['userID'] || (isset($_SESSION['userID']) && !isUser($conn, $_SESSION['userID']));
 if($condition){
     header('Location: ./login.php');
 }

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
//ajouter cour item
if (isset($_POST['ajouter_cousre_item'])) {
   if(!empty($_POST['item_name']) && !empty($_FILES['item_content']['name'])){
     $cour_item_name=$_POST['item_name'];
     $cour_item_content=$_FILES['item_content']['name'];
     $courParentName=$_POST['parent_name'];
     $cour_itemID=rand(10,1000);
     $select_parent="SELECT * FROM cours WHERE name='$courParentName'";
     $query=mysqli_query($db,$select_parent);
     $row=mysqli_fetch_object($query);
     $courParentID=$row->courID;
     $sql="INSERT INTO cour(courID, courParentID, courName, content)
           VALUES('$cour_itemID', $courParentID, '$cour_item_name', '$cour_item_content')";
  
     $query=mysqli_query($db,$sql) ;
        if($query){
          echo 'cour item a ete ajoute avec succes';
     }
     
   }
  }
  //get all cours from db
    $userID = $_SESSION['userID'];

    $sql_cours = "SELECT * FROM module WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql_cours);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $cours = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
?>
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
                 <input type="file" name='item_content' class="box" >
             </div>
             <div class="input-pass">
                 <input type="text" name='parent_name' class="box" placeholder='Entrer le nom de cour...'>
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
             <th>nom</th>
             <th>visiter</th>
             <th>modifier</th>
             <th>suprimer</th>
           </tr>
        </thead>
        <tbody>
         <?php foreach ($cours as $cour ) { ?>
              <tr>
                   <td><?php echo $cour[0] ?></td>
                   <td><?php echo $cour[2] ?></td>
                   <td><a href="cour_details.php?courID=<?php echo $cour[0] ?>"><div class="table_icon visit"><i class="ri-eye-fill"></i></div></a></td>
                   <td><div class="table_icon modify"><i class="ri-loop-left-line"></i></div></td>
                   <td><div class="table_icon delete"><i class="ri-delete-bin-fill"></i></div></td>
              </tr>
           <?php }?>
        </tbody>
</section>
<?php  include 'foot.php' ?>