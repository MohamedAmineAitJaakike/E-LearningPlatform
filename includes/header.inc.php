<?php if(session_status() === PHP_SESSION_NONE) session_start(); 
if(isset($_SESSION['userID']) &&  $_SESSION['user']!="administrateur") include('etudiants_messages.php');
$is_lecture_page = basename($_SERVER['PHP_SELF']) === 'lecture.php';
$is_index_page = basename($_SERVER['PHP_SELF']) === 'index.php';
$is_login_page = basename($_SERVER['PHP_SELF']) === 'login.php';
$is_register_page = basename($_SERVER['PHP_SELF']) === 'register.php';
$is_lectureP_page = basename($_SERVER['PHP_SELF']) === 'lectureProgressif.php';
$is_admin_dashBoard = basename($_SERVER['PHP_SELF']) === 'adminDashboard.php';
$is_adminLogin = basename($_SERVER['PHP_SELF']) === 'adminLogin.php';
$is_admin_register = basename($_SERVER['PHP_SELF']) === 'admin_register.php';

$workdir = (!$is_admin_register && !$is_adminLogin)? "." : "..";

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <!-- font awesome cdn link  -->
   <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
   />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="<?= $workdir ?>/css/styless.css">
   <script defer src="<?= $workdir ?>/js/script.js"></script>
   <script defer src="<?= $workdir ?>/js/admin_script.js"></script>
</head>
<body>

<header class="header">
   <section class="flex">
      
      <div class="left-content">
         <a href="../logout.php" class="logo">
            <img src="<?= $workdir ?>/logo/logo.png" class='logo' width='50' alt="">
         </a>
      </div>

      <?php if(isset($_SESSION['userID']) && $_SERVER['PHP_SELF']=='/nouveaux_cours.php'){ ?>
            <form action="search.php" method="post" class="search-form">
            <input type="text" id="search_box" name="search_box" required autocomplete="off" placeholder="search courses..." maxlength="100" oninput="search_bar(this.value)" onchange="if(this.value == '') search_bar(this.value)" onfocus="document.getElementById('searchResults').style.display='flex';" onblur="document.getElementById('searchResults').style.display='none';">
               <button type="submit" ><i class="ri-search-line"></i></i></button>
            </form>
            <div class="dropdown-search-bar" id="searchResults">

            </div>
         <?php } ?>
      <?php if(isset($_SESSION['userID']) && !$is_index_page && !$is_login_page && !$is_admin_dashBoard && !$is_register_page && isset($_SESSION['user']) && $_SESSION['user'] != "administrateur"){ ?>
         
            <nav class="navbar">
               <a href="<?php echo (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:NULL?>"><i class="ri-home-4-fill"></i></i><span>home</span></a>
               <a href="devoir.php"><i class="ri-briefcase-fill"></i><span>devoirs</span></a>
               <a href="about.php"><i class="ri-question-mark"></i><span>a propos</span></a>
               <a href="contact.php"><i class="ri-mail-fill"></i><span>contact</span></a>
            </nav>
      <div class="popUp" style="display: none;" id="msg1">
         <div class="content" style="width:90%;height:90%;">
            <div>
            <div class="form-container" style="display:flex;flex-direction:column">
               <div class="sub-title" style="display:flex;flex-direction:column">
                  <a  class="title-content" role="button" aria-pressed="true" ><center><button class="btn main-btn" style="white-space:nowrap;" onclick="document.getElementById('msg').style.display='flex';">Boite de reception</button></center></a>
                  <a  class="title-content" role="button" aria-pressed="true" ><center><button class="btn main-btn" style="white-space:nowrap;">Boite d'envoi</button></center></a>
               </div>
            </div>
            <div>
               <center><button class="main-btn" onclick="hidePopUp();document.querySelector('.side-bar').style.display='flex'">Fermer</button></center>
            </div>
            </div>
            </div>
            </div>
     
      <!-- Pour l'icone message: affichage message-->
      <div class="popUp" style="display: none;z-index:10000000000000000000;" id="affichage">
         <div class="content" style="width:30%;height:50%;left:80%;z-index:10000000000000000000;">
            <span id="contenuMessage" style="overflow-y:auto"></span>
            <input id="id" hidden> 
            <div>
               <button class="main-btn" onclick="hidePopUp();document.getElementById('affichage').style.display='none';document.getElementById('msg1').style.display='flex';markAsRead(document.getElementById('id').textContent)">Fermer</button>
            </div>
         </div>
         
      </div>
      <div class="popUp" style="display: none;" id="msg">
         <div class="content" style="width:90%;height:90%;">
            <input type="number" name="userId" id="userId" value="" hidden>
            <input type="text" name="userRole" id="userRole" value="" hidden>
            <div>

               <div class="sub-title">
                  <div class="title-content">
                     <span>Boîte de réception</span>
                  </div> 
               </div>
            </div>
            <br>
          <table>
               <thead>
                  <tr>
                     <th>ID Message</th>
                     <th>Contenu</th>
                     <th>Date réception</th>
                     <th>Reçu de </th>
                     <th>Cours</th>
                     <th>Statut</th>
                  </tr> 
               </thead>
            <tbody>
               <?php $mesgIDs=[];
               //mysqli_data_seek( $messagesRecus,0);
               while ($mesg = $messagesRecus->fetch_assoc()) {
                  $sql="SELECT nom,prenom,role from utilisateurs where id=?";
                  $stmt= $conn->prepare($sql);
                  $stmt->bind_param('i',$mesg['idExpediteur']);
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $senderInfo = $result->fetch_assoc();
                  //cours
                  $sqlC="SELECT titre FROM module WHERE id=?";
                  $stmtC= $conn->prepare($sqlC);
                  $stmtC->bind_param('i',$mesg['idCours']);
                  $stmtC->execute();
                  $resultC = $stmtC->get_result();
                  $mesgIDs[]=$mesg['id'];
                  echo '<tr onclick="afficherContenuMessage(decodeURIComponent(\''.rawurlencode($mesg['contenu']).'\'),'.$mesg['id'].');">';
                  echo '<td>' . $mesg['id'] . '</td>';
                  echo '<td>Cliquer pour voir</td>';
                  echo '<td>' . $mesg['date_envoi'] . '</td>';
                  echo '<td>' . $senderInfo['role'].'. '.$senderInfo['nom'].' '.$senderInfo['prenom'] .'</td>';
                  if ($resultC->num_rows > 0) {
                     // Fetch the course title
                     $cours = $resultC->fetch_assoc();
                     echo '<td>' . $cours['titre'] . '</td>';
                  } else {
                     echo '<td> Pas de cours </td>';
                  }
                  if($mesg['est_lu']) echo '<td> <button style="padding:0;background-color:transparent;color:var(--black);"><i class="ri-mail-open-fill"></i></button> </td>';
                  else echo '<td> <button style="padding:0;background-color:transparent;color:var(--black);"><i class="ri-mail-fill"></i></button> </td>';
                  echo '</tr>';
                  }
               ?>
           </tbody>
         </table>

            <div>
               <?php $mesgIDsString = implode(',', $mesgIDs); ?>
               <button class="delete-btn" onclick="window.location.href='/etudiants_messages.php?mesgID=<?= $mesgIDsString?>';">Marquer le tout comme lu</button>
               <button class="main-btn" onclick="hidePopUp();document.getElementById('msg').style.display='none';document.getElementById('msg1').style.display='flex'">Fermer</button>
            </div>
         </div>
      </div>
      <?php } ?>
         <!--Fin affichage -->
      <div class="icons">
         <?php if(!$is_index_page && !$is_login_page &&!$is_admin_dashBoard && isset($_SESSION['user']) && $_SESSION['user'] != "administrateur"){ ?>
            <button style="background-color:transparent" onclick="document.getElementById('msg1').style.display='flex';document.querySelector('.side-bar').style.display='none';" > 
               <div id="menu-btn" class="ri-chat-1-line">              
                  <?php if(isset($_SESSION['userID'])) echo ($nb_non_lu > 0)? "<span style=\"background-color:red;border-radius:100%;padding:3%;padding-right:4%;padding-left:4%\">".$nb_non_lu."</span>" : " " ?>
               </div>
            </button>
         <?php }?>
         <div id="toggle-btn" class="ri-sun-line"></div>
      </div>
      
   </section>

</header>
