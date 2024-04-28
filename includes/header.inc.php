<?php if(session_status() === PHP_SESSION_NONE) session_start(); ?>

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
   <link rel="stylesheet" href="css/style.css">
   <script defer src="../js/script.js"></script>
</head>
<body>

<header class="header">
   <section class="flex">
      <div class="left-content">
         <a href="../logout.php" class="logo">en</a>
      </div>
      <?php if(isset($_SESSION['userID'])){ ?>
            <form action="search.php" method="post" class="search-form">
               <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
               <button type="submit" ><i class="ri-search-line"></i></i></button>
            </form>
         <?php } ?>
      <?php if(isset($_SESSION['userID'])){ ?>
         
            <nav class="navbar">
               <a href="<?php echo $_SERVER['HTTP_REFERER']?>"><i class="ri-home-4-fill"></i></i><span>home</span></a>
               <a href="devoir.php"><i class="ri-briefcase-fill"></i><span>devoirs</span></a>
               <a href="about.php"><i class="ri-question-mark"></i><span>a propos</span></a>
               <a href="contact.php"><i class="ri-mail-fill"></i><span>contact</span></a>
            </nav>
         
      <?php } ?>
      
      <div class="icons">
         <div id="menu-btn" class="ri-chat-1-line"></div>
         <div id="toggle-btn" class="ri-sun-line"></div>
      </div>
         
   </section>

</header>   