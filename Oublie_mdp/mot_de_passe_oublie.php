<?php include("../includes/header.inc.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENITIALISATION DE MOT DE PASSE</title>
    <link rel="stylesheet" href="/css/style.css">
   
</head>
<body>
    <div class="form-container">
        <form method="GET">
            <h3>RECUPERATION DE MOT DE PASSE</h3>
            <p>VOTRE EMAIL <span>*</span></p>
            <input type="email" name="email" placeholder="ENTREZ VOTRE EMAIL..." required maxlength="50" class="box">
            <center><input type="submit" value="RENITIALISER" name="send" class="btn main-btn"></center>
        </form>
    </div>
</body>
</html>
<?php
// Inclure les fichiers de connexion et de fonctions
include('../includes/connection.inc.php');
include('../includes/fn.inc.php');

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Vérifier si l'e-mail existe dans la base de données
    if (check_user_email($conn, $email)) {
        // Générer un jeton de réinitialisation de mot de passe
        $token = bin2hex(random_bytes(32));

        // Stocker le jeton de réinitialisation de mot de passe dans la base de données
        if (save_reset_token($conn, $email, $token)) {
            // Envoyer un e-mail à l'utilisateur avec le lien de réinitialisation du mot de passe
            $reset_link = 'http://example.com/reset_password.php?token=' . $token;
            $message = 'Cliquez sur le lien suivant pour réinitialiser votre mot de passe : ' . $reset_link;
            mail($email, 'Réinitialisation du mot de passe', $message);
            echo 'Un e-mail de réinitialisation du mot de passe a été envoyé à votre adresse.';
        } else {
            echo 'Une erreur est survenue lors de la génération du lien de réinitialisation du mot de passe.';
        }
    } else {
        echo 'Aucun compte n\'est associé à cette adresse e-mail.';
    }
}
?>
