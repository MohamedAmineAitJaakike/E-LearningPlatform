<?php
$servername = "localhost";
$username = "root";
$port = "3308";
$password = "";
$dbname = "platform";

// Creer une connexion
$conn = mysqli_connect($servername, $username, $password, $dbname,$port);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>
