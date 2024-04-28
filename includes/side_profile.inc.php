<div class="side-bar">

   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
      <img src="../users_images/<?php echo $_SESSION['image'] ?>" class="image" alt="">
      <h3 class="name"><?php echo $_SESSION['name'] ?></h3>
      <p class="role"><?php echo $_SESSION['user'] ?></p>
      <a href="profile.php" class='btn-container ' ><button  class="btn  main-btn">voir profile</button></a>
      <div class="out">
         <form method="GET" action="../logout.php">
            <div class="center_div">
               <button type='submit' name='out' class="btn delete-btn">logout</button>
            </div> 
         </form>
      </div>
   </div>

 <!-- //navar items -->
</div>