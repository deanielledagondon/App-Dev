<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   
   $remember = isset($_POST['remember']) ? true : false;


   $select_users = mysqli_query($conn, "SELECT * FROM `admins` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_email'] = $row['email'];
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['user_image'] = $row['admin_pp'];

        if ($remember) {
         $cookie_name = 'remember_admin';
         $cookie_value = $row['id'];
         setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Cookie will expire after 30 days
      }

      header('location:admin_page.php');

   }
      else {
        $message[] = 'You are not allowed to access this page.';
        header('location:login.php');
        exit();
     }

   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">

      <div class="remember-container">
      <input type="checkbox" name="remember" id="remember">
      <label for="remember">Remember Me</label>
      </div>

      <input type="submit" name="submit" value="login now" class="btn">
      <p>Don't have an account? <a href="admin_register.php">Register now</a></p>
   </form>

</div>

</body>
</html>