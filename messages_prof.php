<?php
session_start();

// Vérifiez si l'utilisateur est connecté et est un professeur
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'professeur') {
    header("Location: login.php"); // Redirigez l'utilisateur vers la page de connexion si nécessaire
    exit();
}

// Inclure le fichier de connexion à la base de données
include 'connection.inc.php';

// Récupérez les messages du professeur à partir de la base de données
$professeurID = $_SESSION['userID'];
$sql = "SELECT * FROM message WHERE idRecepteur = $professeurID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages du Professeur</title>
</head>
<body>
    <h1>Messages reçus</h1>
    <table>
        <tr>
            <th>Expéditeur</th>
            <th>Date</th>
            <th>Contenu</th>
            <th>Répondre</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['idExpediteur'] . "</td>";
                echo "<td>" . $row['date_envoi'] . "</td>";
                echo "<td>" . $row['contenu'] . "</td>";
                echo "<td><a href='repondre_message.php?id=" . $row['id'] . "'>Répondre</a></td>"; // Lien vers la page de réponse
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucun message trouvé.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
