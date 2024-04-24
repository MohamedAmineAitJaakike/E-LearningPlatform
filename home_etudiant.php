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
 //get all cours from db
 $sql="SELECT * FROM cours ";
 $query=mysqli_query($db,$sql);
 $cours=mysqli_fetch_all($query);
 //logout from home etudiant
   //for logout system
if (isset($_GET['out']) && $_SERVER['REQUEST_METHOD']==='GET') {
      session_unset();
      header('location: login.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
   
   <section class="flex">

      <div class="left-content">
          <a href="home.php" class="logo">en</a>
          <form action="search.php" method="post" class="search-form">
             <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
             <button type="submit" ><i class="fas fa-search"></i></button>
          </form>
      </div>
      <nav class="navbar">
         <a href="home_etudiant.php"><i class="fas fa-home"></i><span>home</span></a>
         <a href="devoir.php"><i class="fa-solid fa-briefcase"></i><span>devoirs</span></a>
         <a href="about.php"><i class="fas fa-question"></i><span>a propos</span></a>
         <a href="contact.php"><i class="fas fa-headset"></i><span>contact</span></a>
     </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="./users_images/<?php echo $_SESSION['image'] ?>" class="image" alt="">
      <h3 class="name"><?php echo $_SESSION['name'] ?></h3>
      <p class="role"><?php echo $_SESSION['user'] ?></p>
      <a href="profile.php" class='btn-container' ><button  class="btn main-btn">voir profile</button></a>
      <div class="out">
         <form method="GET">
            <div class="center_div">
               <button type='submit' name='out' class="btn delete-btn">logout</button>
            </div> 
         </form>
      </div>
   </div>

 <!-- //navar items -->
</div>

<section class="home-grid">
    <div class="sub-title">
        <h4 class='title-content'>Mes <span>cours</span></h4>
    </div>
    <?php foreach ($cours as $cour) {?>
        <div class="box">
    <div class="course-item">
         <div class="course-item-image">
              <img src="./images/pic-1.jpg" width='100' alt="">
         </div>
         <div class="course-item-text">
             <div class="cour-infos">
                 <div class="cour-nom">
                     <h4><?php echo $cour[2] ?></h4>
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
      <div class="inscription-box">
         <div class="icon">
             <i class="fa-regular fa-circle-xmark"></i>
         </div>
          <div class="pass-box">
            <div class="sub-title">
                <h4 class="title-content">inscription au cour: <span>dev web 1.</span></h4>
            </div>
               <div class="my-form-container">
                 <form action="" method="post">
                     <div class="my-form">
                         <div class="input-pass">
                             <input type="text" placeholder='tapez password...'>
                          </div>
                          <div class="btn-pass">
                             <button class='sinscrir-btn'>s'inscrire</button>
                          </div>
                     </div>
                 </form>
               </div>
          </div>
      </div>
    </div>
    <?php }?>
</section>

<!-- <footer class="footer">

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer> -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>