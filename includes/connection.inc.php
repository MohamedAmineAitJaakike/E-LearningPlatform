<?php
$servername = "localhost";
$username = "root";
$port = "3306";
$password = "Hf_MySQl_root+2684";
$dbname = "platform";

// Creer une connexion
$conn = mysqli_connect($servername, $username, $password, $dbname,$port);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>
