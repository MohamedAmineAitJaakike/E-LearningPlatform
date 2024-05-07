<?php
session_start();

// Vérifiez si l'utilisateur est connecté et est un professeur
if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'professeur') {
    header("Location: login.php"); // Redirigez l'utilisateur vers la page de connexion si nécessaire
    exit();
}

// Inclure le fichier de connexion à la base de données
include 'connection.inc.php';

// Vérifiez si le formulaire d'annonce est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contenu_annonce'])) {
    $contenu_annonce = $_POST['contenu_annonce'];

    // Enregistrez l'annonce dans la base de données pour chaque étudiant du cours
    $idProfesseur = $_SESSION['userID'];
    $sql_students = "SELECT id FROM utilisateurs WHERE role = 'etudiant'";
    $result_students = $conn->query($sql_students);

    if ($result_students->num_rows > 0) {
        while ($row = $result_students->fetch_assoc()) {
            $idEtudiant = $row['id'];
            $sql_insert_annonce = "INSERT INTO message (idCours, idExpediteur, idRecepteur, contenu, est_annonce) VALUES (NULL, $idProfesseur, $idEtudiant, '$contenu_annonce', 1)";
            $conn->query($sql_insert_annonce);
        }
    }

    // Rediriger l'utilisateur vers la page appropriée après l'envoi de l'annonce
    header("Location: annonces_cours.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annonces de Cours</title>
</head>
<body>
    <h1>Annonces de Cours</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="contenu_annonce">Contenu de l'annonce :</label><br>
        <textarea id="contenu_annonce" name="contenu_annonce" rows="5" cols="50" required></textarea><br>
        <input type="submit" value="Envoyer l'annonce">
    </form>
</body>
</html>
