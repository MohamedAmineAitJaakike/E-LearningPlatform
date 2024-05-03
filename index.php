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
</body>
</html>
