<?php
include 'config.php';

if (isset($_POST['submit'])) {
   $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
   $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
   $middleInitial = mysqli_real_escape_string($conn, $_POST['middleInitial']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $position = mysqli_real_escape_string($conn, $_POST['position']);
   $monthlySalary = mysqli_real_escape_string($conn, $_POST['monthlySalary']);

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
               mysqli_query($conn, "INSERT INTO `admins` (username, email, password, admin_pp) VALUES ('$username', '$email', '$cpass', '$file_path')") or die('query failed');
               $message[] = 'Registered successfully!';
               header('location: admin_login.php');
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
   <link rel="stylesheet" href="css/admin-style.css">

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

         <div class="row-container">
            <input type="text" name="firstName" placeholder="First name" required class="box">
            <input type="text" name="lastName" placeholder="Last name" required class="box">
            <input type="text" name="middleInitial" placeholder="M.I" required class="box">
         </div>

         <div class="row-container">
         <input type="username" name="username" placeholder="Username" required class="box">
         <input type="email" name="email" placeholder="Email" required class="box">
         </div>

         <div class="row-container">
            <input type="password" name="password" placeholder="password" required class="box">
            <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
         </div>

         <input type="number" name="age" placeholder="Age" required class="box">
         <input type="text" name="address" placeholder="Address" required class="box">

         <div class="row-container">
         <input type="text" name="position" placeholder="Position" required class="box">
         <input type="number" name="monthlySalary" placeholder="Monthly salary" required class="box">
         </div>

         <input type="file" name="admin_pp" placeholder="Profile Picture" required class="box">
         <input type="submit" name="submit" value="register now" class="btn">
         <p>Already have an account? <a href="admin_login.php">Login now</a></p>
      </form>
   </div>
</body>

</html>
