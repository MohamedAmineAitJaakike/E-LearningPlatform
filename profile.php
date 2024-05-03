<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once'./includes/header.inc.php';
if(session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body


<section class="user-profile">

   <center><h1 class="heading">Votre Profil</h1><center>

   <div class="info">

      <div class="user">
         <img src="./users_images/<?php echo $_SESSION['image'] ?>" class="image" alt="">
         <h3 class="name"><?php echo $_SESSION['name'] ?></h3>
         <p class="role"><?php echo $_SESSION['user'] ?></p>
          <div class='center'> <a href="update_profil.php" class="btn main-btn">update profile</a></div>
      </div>
   
     
      </div>
   </div>

</section>


<footer class="footer">

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>