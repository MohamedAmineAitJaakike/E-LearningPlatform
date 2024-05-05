<?php include("./includes/header.inc.php");
session_unset();
session_destroy();
?><!-- si le remember me token n'est pas selectionne-->

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <div class="form-container">
      <form action="process/process_login.php" method="POST">
         <h3>SE CONNECTER</h3>
         <p>VOTRE EMAIL <span>*</span></p>
         <input type="email" name="email" placeholder="ENTREZ VOTRE EMAIL..." required maxlength="50" class="box">
         <p>VOTRE MOT DE PASSE <span>*</span></p>
         <input type="password" name="password" placeholder="ENTREZ VOTRE MOT DE PASSE..." required maxlength="20" class="box">

         <label for="remember_me"><input type="checkbox" name="remember_me" id="remember_me"> Se souvenir de moi</label>
         <!-- a implementer-->

         <center><input type="submit" value="SE CONNECTER" name="send" class="btn main-btn"></center>

         <center><a href="./Oublie_mdp/mot_de_passe_oublie.php">Mot de passe oublié ?</a></center><!-- a implementer-->
      </form>

   </div>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
</body>
</html>