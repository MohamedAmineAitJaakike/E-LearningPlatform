<?php

include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once './includes/header.inc.php';
if (session_status() === PHP_SESSION_NONE) session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composer un message</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Style pour centrer le contenu */
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <!-- Conteneur principal pour centrer le contenu -->
    <div class="center-content">
        <!-- Formulaire de composition de message -->
        <form action="traitement.php" method="POST" id="formComposeMessage" style="display: flex;">
            <div class="bubble-container">
                <div class="bubble">Destinataire:</div>
                <select id="destinataire" name="destinataire">
                    <?php
                    // Récupérer la liste des professeurs depuis la base de données
                    $sql = "SELECT id, nom, prenom FROM utilisateurs WHERE role = 'professeur'";
                    $result = $conn->query($sql);

                    // Afficher les options de la liste déroulante
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['prenom'] . " " . $row['nom'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="spacer"></div> <!-- Ajout d'un espace entre les deux bulles -->

            <div class="bubble-container">
                <div class="bubble">Contenu:</div>
                <textarea id="contenu" name="contenu" rows="4" cols="50"></textarea>
            </div>

 
            <input type="submit" value="Envoyer">
            <script>

</script>

        </form>
    </div>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <script>
    function toggleMessageSection() {
        document.getElementById('msg').style.display = 'block'; // Afficher la section de message
    }
    </script>

</body>

</html>