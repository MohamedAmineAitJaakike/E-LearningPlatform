 <?php
 //for connect
$localhost='localhost';
$username='root';
$password='';
$db_name='platform';
$db=mysqli_connect($localhost,$username,$password,$db_name);
if(!$db){
   echo 'error in db connection:'.mysqli_connect_error();
}
session_start();
if(!$_SESSION['name']){
   header('Location: login.php');
}
 if (isset($_POST['ajouter_course'])) {
 if(!empty($_POST['cour_name']) && !empty($_POST['cour_password'])){
   $cour_name=$_POST['cour_name'];
   $cour_password=$_POST['cour_password'];
   $courID=rand(10,1000);
   $user_id=$_SESSION['userID'];
   
   $sql="INSERT INTO cours(courID, userID, name, password)
         VALUES('$courID', $user_id, '$cour_name', '$cour_password')";

   $query=mysqli_query($db,$sql) ;
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
  $userID=$_SESSION['userID'];
  $sql_cours="SELECT * FROM cours WHERE userID='$userID'";
  $result=mysqli_query($db,$sql_cours);
  $cours=mysqli_fetch_all($result);
  //for logout system
  if (isset($_GET['out']) && $_SERVER['REQUEST_METHOD']==='GET') {
       session_unset();
       header('location: login.php');
  }
  
?>
<!-- head included in php file -->
<?php include 'head.php'; ?>
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
                <div class="static-name">
                    <h4>cours</h4>
                    <p class="static-value">+13</p>
                </div>
            </div>

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
                 <input type="text" name='cour_name' class="box" placeholder='Entere le nom de cour...'>
             </div>
             <div class="input-pass">
                 <input type="text" name='cour_password' class="box" placeholder='Entere le mot de pass de cour...'>
             </div>
             <button type='submit' name='ajouter_course' class='btn main-btn'>ajouter</button>
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