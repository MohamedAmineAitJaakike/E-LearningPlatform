<?php 
session_start();
session_unset();
session_destroy();
include("../includes/header.inc.php");
?><!-- si le remember me token n'est pas selectionne-->

<div class="form-container">
   <form action="../process/process_login.php" method="POST">
      <h3>Se connecter en tant qu'Administrateur</h3>
      <input type="checkbox" name="isAdmin" id="isAdmin" checked hidden>
      <p>VOTRE EMAIL <span>*</span></p>
      <input type="email" name="email" placeholder="ENTREZ VOTRE EMAIL..." required maxlength="50" class="box">
      <p>VOTRE MOT DE PASSE <span>*</span></p>
      <input type="password" name="password" placeholder="ENTREZ VOTRE MOT DE PASSE..." required maxlength="20" class="box">

      <label for="remember_me"><input type="checkbox" name="remember_me" id="remember_me"> Se souvenir de moi</label>
      <!-- a implementer-->

      <center><input type="submit" value="SE CONNECTER" name="send" class="btn main-btn"></center>

      <center><a href="../Oublie_mdp/mot_de_passe_oublie.php">Mot de passe oublié ?</a></center><!-- a implementer-->
   </form>

</div>