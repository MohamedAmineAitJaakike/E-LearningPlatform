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
//for signup
session_start();
if (isset($_POST['send'])) {
   $name=$_POST['name'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   $c_password=$_POST['c_password'];
   $userType=$_POST['user_type'];
    $image_name=$_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $direction='./users_images';
   if($password === $c_password){
        $userID=rand(10,1000000);
        $_SESSION['name']=$name;
        $_SESSION['email']=$email;
        $_SESSION['userID']=$userID;
        $_SESSION['image']=$image_name;
        $_SESSION['user']=$userType;
        $query=mysqli_query($db,"INSERT INTO users(userID,name, email, password, image, user)
        VALUES ('$userID','$name', '$email', '$password', '$image_name', '$userType')");
       if($query){
         move_uploaded_file($tmp_name,"$direction/$image_name");
          if($userType === 'etudiant'){
            header('Location: home_etudiant.php');
          } 
          else{
            header('Location: home_professeur.php');
          }
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
      <p>your name <span>*</span></p>
      <input type="text" name="name" placeholder="enter your name" required  class="box">
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email" required  class="box">
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" required  class="box">
      <p>confirm password <span>*</span></p>
      <input type="password" name="c_password" placeholder="confirm your password" required  class="box">
      <p>le type d'utilisateur <span>*</span></p>
       <select name="user_type" class='box'>
         <option value="professeur">professeur</option>
         <option value="etudiant">etudiant</option>
       </select>
      <p>select profile <span>*</span></p>
      <input type="file" name='image'  required class="box">
      <button type='submit' name='send' class='btn main-btn'>submit</button>
   </form>
</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>