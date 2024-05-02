<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
include('./includes/side_profile.inc.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit; // Assurez-vous de terminer le script après la redirection
}
$userID=$_SESSION['userID'];
// Récupérer les messages des étudiants pour cet administrateur
$messages='';
$sql = "SELECT * FROM message WHERE idRecepteur = '$userID'";
$result = $conn->query($sql);
// Afficher les messages
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages.=`
                    <div class="message">
                          <span class="sender">`.$row["idExpediteur"].`</span>
                          <span class="timestamp">`.$row["date_envoi"].`</span>
                          <div class="content">
                              `.$row["contenu"].`
                          </div>
                    </div>
            `;
    }
}

?>
<?php require_once './includes/header.inc.php';?>
<section class="home-grid">
 <div class="container">
    <div class="sub-title">
     <div class="title-content">
          Boîte de <span>réception</span>
     </div>
    </div>
            <?php
               if(empty($messages)){
                    echo'<div class="message">
                             <span class="sender">no one</span>
                             <span class="timestamp">13/10/2002</span>
                             <div class="content">
                                 hello !
                             </div>
                        </div>';
               }
             else{
                echo $messages;
             }
            ?>
        <!-- Formulaires de composition -->
    </div>
</section>

</body>
</html>
<?php include 'foot.php'; ?>
