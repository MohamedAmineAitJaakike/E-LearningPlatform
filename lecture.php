<?php
include('./includes/connection.inc.php');
include('./includes/fn.inc.php');
require_once'./includes/header.inc.php';
if(session_status() === PHP_SESSION_NONE) session_start(); 
if(isset($_GET['courID'])) {
    //place correctement
        $nomCours=$_GET['nomCours'];
        $courID = $_GET['courID'];

        $sql = "SELECT * FROM chapitre WHERE IdModule = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $courID);
        $stmt->execute();
        $result = $stmt->get_result();
    if(!est_progressif($conn,$_GET['courID'],$_GET['nomCours'])){
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "
                <!DOCTYPE html>
                    <html lang=\"en\">
                    <head>
                        <meta charset=\"UTF-8\">
                        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                        <title>Document</title>
                        <link rel=\"stylesheet\" href=\"./css/style.css\">
                    </head>
                    <body>
                    <div class=\"box\">
                                    <div class=\"course-item\">
                                        
                                        <div class=\"course-item-text\">
                                            <div class=\"cour-infos\">
                                                <div class=\"cour-nom\">
                                                    <h4> $row[contenu] </h4>
                                                </div>
                                                <div class=\"cour-infos\" style=\"column-gap:2%;\">
                                                    <div class=\"center_div\">

                                                            <button class=\"btn main-btn\">Lecture</button>
                                                        </a>
                                                    </div> 
                                                    <div class=\"center_div\" >
                                                        <button class=\"btn delete-btn\" >Done </button>
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                ";
            }
        } else {
            echo "<div class=\"sub-title\" style=\"margin-left:30%;margin-top:10%\"><h1 class='title-content'>Aucun <span>chapitre</span> disponible pour ce cours.</h1><div>";
        }
   
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./css/style.css">
        <script defer src="./js/script.js"></script>
    </head>
    <body>
        <div class="side-bar" style="display:flex;flex-direction:row;">

            <div class="profile" style="display:flex;flex-direction:row;column-gap:1%;">

                <div class="button-container">
                
                    <!-- Button for "Ressources Cours" -->
                    <div>
                        <?php echo "<div class=\"sub-title\" ><h1 class='title-content'>Module <span>$nomCours</span></h1><div>";?>
                        <button type="button" class="custom-button" onclick="toggleUnderline(this)">
                            <h1 class="button-text title-content"><span>Ressources</span></h1>
                        </button>
                        <br>
                        <br>
                        <div class="dropdown-content" id="ressourcesDropdown">
                            <!-- List of options for Ressources -->
                            <?php 
                                if($result->num_rows > 0) {
                                    // Afficher les chapitres associés au cours
                                    while($row = $result->fetch_assoc()) {
                                        echo "<a style=\"color:white;\" href=\"#\">Chapitre : " . $row['contenu'] . "</a>";
                                    }
                                } else {
                                    echo "<h4 class='title-content' style=\"font-size:100%;\">Auccune <span>ressource</span> disponible pour ce cours.</h4>";
                                } 
                            ?>
                        </div>
                    </div>
                </div>


            </div>
            </div>
            

    </body>
    </html>
    <?php }else{ 
        
        header('Location: home_etudiant.php');}
        ?>
<?php }else{

    if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "
                <!DOCTYPE html>
                    <html lang=\"en\">
                    <head>
                        <meta charset=\"UTF-8\">
                        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                        <title>Document</title>
                        <link rel=\"stylesheet\" href=\"./css/style.css\">
                    </head>
                    <body>
                    <div class=\"box\">
                                    <div class=\"course-item\">
                                        
                                        <div class=\"course-item-text\">
                                            <div class=\"cour-infos\">
                                                <div class=\"cour-nom\">
                                                    <h4> $row[contenu] </h4>
                                                </div>
                                                <div class=\"cour-infos\" style=\"column-gap:2%;\">
                                                    <div class=\"center_div\">

                                                            <button class=\"btn main-btn\">Lecture</button>
                                                        </a>
                                                    </div> 
                                                    <div class=\"center_div\">
                                                        <button class=\"btn delete-btn\" style=\"background-color:darkgrey\" onclick=\"alert('hey')\" disabled>Done </button>
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                ";
            }
        }


    }?>