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
   <title>Composer un message</title>
</head>
<body>

   <!-- Formulaire de composition de message -->
   <form action="compose.php" method="POST">
      <label for="type">Type de message:</label>
      <select name="type" id="type">
         <option value="question">Question</option>
         <option value="annonce">Annonce</option>
      </select><br><br>

      <label for="destinataire">Destinataire:</label>
      <input type="text" id="destinataire" name="destinataire"><br><br>

      <label for="contenu">Contenu:</label><br>
      <textarea id="contenu" name="contenu" rows="4" cols="50"></textarea><br><br>

      <input type="submit" value="Envoyer">
   </form>

</body>
</html>
