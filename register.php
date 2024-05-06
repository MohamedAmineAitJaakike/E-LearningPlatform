<?php
//to make the difference between register and register_admin
$is_admin_register = basename($_SERVER['PHP_SELF']) === 'admin_register.php';
//for connect
   if(!$is_admin_register)
      include("./includes/header.inc.php");

   include("$workdir/includes/connection.inc.php");
   include("$workdir/includes/fn.inc.php");
//for signup
if(session_status()==PHP_SESSION_NONE) session_start();
if (isset($_POST['send'])) {
   $name=$_POST['name'];
   $prenom=$_POST['prenom'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $c_password=$_POST['c_password'];
   $userType=(isset($_POST['user_type']))? $_POST['user_type'] : "administrateur";
   $image_name=$_FILES['image']['name'];
   $tmp_name=$_FILES['image']['tmp_name'];
   $direction="$workdir/users_images";
   if($password === $c_password){
        $userID=rand(10,1000000);
        $_SESSION['name']=$name;
        $_SESSION['prenom']=$prenom;
        $_SESSION['email']=$email;
        $_SESSION['userID']=$userID;
        $_SESSION['image']=$image_name;
        $_SESSION['user']=$userType;
        var_dump('userID');
        
        if(!check_user_exist($conn, $name, $prenom, $email, $password, $userType)){
         $result = register($conn, $name, $prenom, $email, $password, $image_name, $userType);
         if($result){
            move_uploaded_file($tmp_name,"$direction/$image_name");
            if($userType === 'etudiant'){
               header('Location: home_etudiant.php');
            } 
            elseif ($userType === 'professeur'){
               header('Location: home_professeur.php');
            }
            else{
               header('Location: ../adminDashboard.php');
            }
         }
      }else{ echo "<center><h1 style=\"color:red;bottom:10%;\">Utilisateur existe Deja!<h1></center>";
         sleep(3);
      }
       }
    }
  
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="form-container">
   <form  method="POST" enctype="multipart/form-data">
      <h3>register now</h3>
      <p>Votre nom <span>*</span></p>
      <input type="text" name="name" placeholder="enter your name" required  class="box">
      <p>Votre prenom <span>*</span></p>
      <input type="text" name="prenom" placeholder="entrez votre prenom" required  class="box">
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" required  class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" required  class="box">
      <p>confirm password <span>*</span></p>
      <input type="password" name="c_password" placeholder="confirm your password" required  class="box">

      <?php if(!$is_admin_register){ ?>

         <p>le type d'utilisateur <span>*</span></p>
          <select name="user_type" class='box'>
            <option value="professeur">professeur</option>
            <option value="etudiant">etudiant</option>
          </select>

      <?php } ?>

      <p>select profile <span>*</span></p>
      <input type="file" name='image'  required class="box">
      <center><button type='submit' name='send' class='btn main-btn'>submit</button></center>
   </form>
</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
