<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['destinataire'], $_POST['contenu']) && !empty($_POST['destinataire']) && !empty($_POST['contenu'])) {

        // Récupérez les données du formulaire
        $destinataire = $_POST['destinataire'];
        $contenu = $_POST['contenu'];
        $idExpediteur = $_SESSION['userID']; 

        // Code pour se connecter à la base de données
        include 'connection.inc.php';  

        // Utilisation d'une requête préparée pour l'insertion sécurisée des données
        $sql_insert = "INSERT INTO message (idCours, idExpediteur, idRecepteur, contenu, est_annonce) VALUES (NULL, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param('iis', $idExpediteur, $destinataire, $contenu);
        
        if ($stmt->execute()) {
            // Message inséré avec succès
            $stmt->close();
            $conn->close();
            header("Location: profile.php"); // Redirection vers la page de profil  
            exit();
        } else {
            // Erreur lors de l'insertion du message
            echo "Erreur lors de l'insertion du message : " . $conn->error;
        }

        // Fermer la connexion à la base de données
        $stmt->close();
        $conn->close();
    } else {
        // Gérer les erreurs si des champs sont manquants ou vides
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}
?>
