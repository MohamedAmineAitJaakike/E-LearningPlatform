<?php include('./includes/header.inc.php'); ?>
<?php include('./includes/connection.inc.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page D'acceuil</title>
</head>
<body>
    <!-- Cookieee-->
    <?php
    // Vérifie si le cookie "cookiesAccepted" est défini et s'il est égal à true
    if (!isset($_COOKIE['cookiesAccepted']) || $_COOKIE['cookiesAccepted'] !== 'true') {
        // Si les cookies ne sont pas acceptés ou le cookie n'est pas défini, affiche la bannière de cookies
        echo '<div class="cookie-banner" id="cookieBanner">
            En utilisant notre site, vous acceptez notre utilisation de cookies. 
            <button class="cookie-btn" onclick="acceptCookies()">Accepter</button>
            <button class="cookie-btn" onclick="rejectCookies()">Refuser</button>
        </div>';
    }
    ?>


    <div class="form-container" style="display:flex;flex-direction:column">
        <div class="sub-title">
            <h1 class='title-content'>Bienvenue sur votre plateforme d'apprentissage <span style="color:#fc8021;">"EnL"</span></h1>
        </div>
        <br>
        <br>
        <br>
        <div class="sub-title" style="display:flex;flex-direction:column">
            <a href="login.php" class="title-content" role="button" aria-pressed="true"><center><button class="btn main-btn">Connexion</button></center></a>
            <a href="register.php" class="title-content" role="button" aria-pressed="true"><center><button class="btn main-btn">Inscription</button></center></a>
        </div>
    </div>

    <!-- Script pour gérer l'acceptation des cookies -->
    <script>
        function acceptCookies() {
            // Enregistre l'acceptation des cookies dans un cookie nommé "cookiesAccepted" avec une durée de validité de 30 jours
            document.cookie = "cookiesAccepted=true; max-age=" + 7 * 24 * 60 * 60;
            // Recharge la page pour masquer la bannière de cookies
            document.getElementById('cookieBanner').style.display='none';
        }

        function rejectCookies() {
            // Enregistre le refus des cookies dans un cookie nommé "cookiesAccepted" avec une durée de validité de 30 jours
            document.cookie = "cookiesAccepted=false; max-age=" + 7 * 24 * 60 * 60;
            // Recharge la page pour masquer la bannière de cookies
            document.getElementById('cookieBanner').style.display='none';
        }
    </script>
</body>
</html>
