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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <!-- font awesome cdn link  -->
   <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
   />
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
             <button type="submit" ><i class="ri-search-line"></i></i></button>
          </form>
      </div>
      <nav class="navbar">
         <a href="home_professeur.php"><i class="ri-home-4-fill"></i></i><span>home</span></a>
         <a href="devoir.php"><i class="ri-briefcase-fill"></i><span>devoirs</span></a>
         <a href="about.php"><i class="ri-question-mark"></i><span>a propos</span></a>
         <a href="contact.php"><i class="ri-mail-fill"></i><span>contact</span></a>
     </nav>

      <div class="icons">
         <div id="menu-btn" class="ri-chat-1-line"></div>
         <div id="toggle-btn" class="ri-sun-line"></div>
      </div>
   </section>

</header>   

<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="images/pic-1.jpg" class="image" alt="">
      <h3 class="name"><?php echo $_SESSION['name'] ?></h3>
      <p class="role"><?php echo $_SESSION['user'] ?></p>
      <a href="profile.php" class='btn-container ' ><button  class="btn  main-btn">voir profile</button></a>
      <a href="profile.php" class='btn-container'><button class="btn delete-btn">logout</button></a>
   </div>

 <!-- //navar items -->
</div>
<!-- //home grid -->
<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>pourquoi choisir nous?</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut dolorum quasi illo? Distinctio expedita commodi, nemo a quam error repellendus sint, fugiat quis numquam eum eveniet sequi aspernatur quaerat tenetur.</p>
      </div>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-graduation-cap"></i>
         <div>
            <h3>+10k</h3>
            <p>online courses</p>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-user-graduate"></i>
         <div>
            <h3>+40k</h3>
            <p>brilliant students</p>
         </div>
      </div>

      <div class="box">
         <i class="fas fa-chalkboard-user"></i>
         <div>
            <h3>+2k</h3>
            <p>expert tutors</p>
         </div>
      </div>
   </div>

</section> 


<!-- <footer class="footer">

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer> -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>