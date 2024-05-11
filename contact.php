<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once'./includes/header.inc.php';
if(session_status() === PHP_SESSION_NONE) session_start(); 
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


<section class="contact" style="margin:0;padding:0">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>get in touch</h3>
         <input type="text" placeholder="enter your name" name="name" required maxlength="50" class="box">
         <input type="email" placeholder="enter your email" name="email" required maxlength="50" class="box">
         <input type="number" placeholder="enter your number" name="number" required maxlength="50" class="box">
         <textarea name="msg" class="box" placeholder="enter your message" required maxlength="1000" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" class="btn main-btn" name="submit">
      </form>

   </div>
<center>
   <div class="box-container" style="display:block">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>phone number</h3>
         <a href="tel:+212771372111">+212-771-372-111</a>
         <a href="tel:+212777479646">+212-777-479-646</a>
      </div>
      
      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>email address</h3>
         <a href="mailto:moussa.dembele@etu.uae.ac.ma">moussa.dembele@etu.uae.ac.ma</a>
         <a href="mailto:heriniavofalyaimeric.andriamihanta@etu.uae.ac.ma">heriniavofalyaimeric.andriamihanta@etu.uae.ac.ma</a>
      </div>

      <div class="box" style="overflow-x:auto;width:fit-content">
         <i class="fas fa-map-marker-alt"></i>
         <h3>office address</h3>
         <a href="#">ENSATE</a>
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3245.655414004929!2d-5.367121725036159!3d35.56221157262593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b4245d0028d49%3A0xf354d6c86ac4d983!2sENSA%20%3A%20%C3%89cole%20Nationale%20des%20Sciences%20Appliqu%C3%A9es_T%C3%A9touan!5e0!3m2!1sfr!2sma!4v1715459542087!5m2!1sfr!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

   </div>
   </center>

</section>
<!-- <footer class="footer">

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer> -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>
