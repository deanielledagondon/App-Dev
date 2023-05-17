<?php
include 'config.php';

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select_users = mysqli_query($conn, "SELECT * FROM `admins` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $message[] = 'User already exists!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Confirm password not matched!';
      } else {
         // File upload
         $file_name = $_FILES['admin_pp']['name'];
         $file_tmp = $_FILES['admin_pp']['tmp_name'];
         $file_size = $_FILES['admin_pp']['size'];
         $file_type = $_FILES['admin_pp']['type'];
         $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

         $extensions = array("jpeg", "jpg", "png");

         if (in_array($file_ext, $extensions) === false) {
            $message[] = "Extension not allowed, please choose a JPEG or PNG file.";
         } elseif ($file_size > 26214400) {
            $message[] = 'File size must be less than 25 MB';
         } else {
            $target_directory = "uploads/";
            $target_file = $target_directory . $file_name;

            if (move_uploaded_file($file_tmp, $target_file)) {
               $file_path = 'uploads/' . $file_name;
               mysqli_query($conn, "INSERT INTO `admins` (name, email, password, admin_pp) VALUES ('$name', '$email', '$cpass', '$file_path')") or die('query failed');
               $message[] = 'Registered successfully!';
               header('location: login.php');
            } else {
               $message[] = 'Error uploading the file. Please try again.';
            }
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
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '
         <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>

   <div class="form-container">
      <form action="" method="post" enctype="multipart/form-data">
         <h3>Register now</h3>
         <input type="text" name="name" placeholder="Enter your name" required class="box">
         <input type="email" name="email" placeholder="Enter your email" required class="box">
         <input type="password" name="password" placeholder="Enter your password" required class="box">
         <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
         <input type="file" name="admin_pp" placeholder="Profile Picture" required class="box">
         <input type="submit" name="submit" value="register now" class="btn">
         <p>Already have an account? <a href="admin_login.php">Login now</a></p>
      </form>
   </div>
</body>

</html>
