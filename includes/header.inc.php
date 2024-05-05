<?php if(session_status() === PHP_SESSION_NONE) session_start(); 
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
   <link rel="stylesheet" href="<?= $workdir ?>/css/style.css">
   <script defer src="<?= $workdir ?>/js/script.js"></script>
</head>
<body>

<header class="header">
   <section class="flex">
      
      <div class="left-content">
         <a href="../logout.php" class="logo">
            <img src="<?= $workdir ?>/logo/logo.png" class='logo' width='50' alt="">
         </a>
      </div>

      <?php if(isset($_SESSION['userID']) && !$is_lecture_page && !$is_index_page && !$is_register_page && !$is_login_page && !$is_lectureP_page){ ?>
            <form action="search.php" method="post" class="search-form">
               <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
               <button type="submit" ><i class="ri-search-line"></i></i></button>
            </form>
         <?php } ?>
      <?php if(isset($_SESSION['userID']) && !$is_index_page && !$is_login_page && !$is_admin_dashBoard && !$is_register_page && isset($_SESSION['user']) && $_SESSION['user'] != "administrateur"){ ?>
         
            <nav class="navbar">
               <a href="<?php echo (isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:NULL?>"><i class="ri-home-4-fill"></i></i><span>home</span></a>
               <a href="devoir.php"><i class="ri-briefcase-fill"></i><span>devoirs</span></a>
               <a href="about.php"><i class="ri-question-mark"></i><span>a propos</span></a>
               <a href="contact.php"><i class="ri-mail-fill"></i><span>contact</span></a>
            </nav>
         
      <?php } ?>

      <div class="icons">
         <?php if(!$is_index_page && !$is_login_page &&!$is_admin_dashBoard && isset($_SESSION['user']) && $_SESSION['user'] != "administrateur"){ ?>
            <a href="etudiants_messages.php" > <div id="menu-btn" class="ri-chat-1-line"></div></a>
         <?php }?>
         <div id="toggle-btn" class="ri-sun-line"></div>
      </div>

   </section>

</header>   