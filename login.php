<?php
//for connect
$localhost='localhost';
$username='root';
$password='';
$db_name='platform';
$db=mysqli_connect($localhost,$username,$password,$db_name);
if(!$db){
   echo 'error in db connection:'.mysqli_connect_error();
}
session_start();
//for login
if (isset($_POST['send'])) {
   $email=$_POST['email'];
   $password=$_POST['password'];

   $query=mysqli_query($db,"SELECT * FROM users WHERE email='$email' AND  password='$password'");
       if($query){
          if(mysqli_num_rows($query)>0){
            $row=mysqli_fetch_object($query);
             if($row->user == 'professeur'){
               $_SESSION['userID']=$row->userID;
               $_SESSION['name']=$row->name;
               $_SESSION['user']=$row->user;
               $_SESSION['image']=$row->image;
               header('Location: home_professeur.php');
             }
             else{
               header('Location: home_etudiant.php');
             }
          }
          else{
            echo'email ou mot de pass incorrect!';
          }
       }
       else{
         echo'error en serveur!';
       }
   } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title> 
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
   <form action="" method="POST" enctype="multipart/form-data">
      <h3>login now</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" required maxlength="20" class="box">
      <input type="submit" value="login new" name="send" class="btn main-btn">
   </form>
</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>