<?php
include 'config.php';

$message = array(); // Initialize the message array

if(isset($_POST['submit'])){
   $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
   $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
   $middleInitial = mysqli_real_escape_string($conn, $_POST['middleInitial']);
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $position = mysqli_real_escape_string($conn, $_POST['position']);
   $monthlySalary = mysqli_real_escape_string($conn, $_POST['monthlySalary']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $admin_pp = $_FILES['admin_pp'] ?? null;

   $terms = isset($_POST['terms']) ? true : false; // Check if the "terms" checkbox is checked


   $select_users = mysqli_query($conn, "SELECT * FROM `admins` WHERE email = '$email' AND password = '$password'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User already exists!';
   }else{
      if($password != $cpassword){
         $message[] = 'Confirm password not matched!';
      }else{
         if(!$terms){ // Check if the user agreed to the terms and conditions
            $message[] = 'Please agree to the Terms and Conditions!'; 
      }else{
         // File upload
         if ($admin_pp !== null && $admin_pp['error'] === UPLOAD_ERR_OK && $admin_pp['size'] > 0) {
            $file_name = $admin_pp['name'];
            $file_tmp = $admin_pp['tmp_name'];
            $file_size = $admin_pp['size'];
            $file_type = $admin_pp['type'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $extensions = array("jpeg", "jpg", "png");

            if(in_array($file_ext, $extensions) === false){
               $message[] = "Extension not allowed, please choose a JPEG or PNG file.";
            } elseif($file_size > 26214400) {
               $message[] = 'File size must be less than 25 MB';
            } else {
               $target_directory = "uploads/";
               $target_file = $target_directory . $file_name;

               if (move_uploaded_file($file_tmp, $target_file)) {
                  $file_path = 'uploads/' . $file_name;
                  mysqli_query($conn, "INSERT INTO `admins` (firstName, lastName, middleInitial, age, address, position, monthlySalary, username,  email, password, admin_pp) VALUES ('$firstName', '$lastName', '$middleInitial', '$age', '$address', '$position', '$monthlySalary', '$username', '$email', '$password', '$file_path')") or die('query failed');
                  $message[] = 'Registered successfully!';
                  header('location: login.php');
                  exit();
               } else {
                  $message[] = 'Error uploading the file. Please try again.';
                }
             }
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
   <link rel="stylesheet" href="css/admin_style.css">
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
            <input type="text" name="firstName" placeholder="First Name" required class="box">
            <input type="text" name="lastName" placeholder="Last Name" required class="box">
            <input type="text" name="middleInitial" placeholder="M.I" required class="box">
         </div>
         <div class="row-container">
            <input type="text" name="username" placeholder="Username" required class="box">
            <input type="email" name="email" placeholder="Email" required class="box">
         </div>
         <div class="row-container">
            <input type="password" name="password" placeholder="Password" required class="box">
            <input type="password" name="cpassword" placeholder="Confirm Password" required class="box">
         </div>
         <div class="row-container">
         <input type="number" name="age" placeholder="Age" required class="box">
         <input type="number" name="phoneNum" placeholder="Phone No." required class="box">
         </div>
         <input type="text" name="address" placeholder="Address" required class="box">
         <div class="row-container">
            <input type="text" name="position" placeholder="Position" required class="box">
            <input type="number" name="monthlySalary" placeholder="Monthly salary" required class="box">
         </div>
         
         <input type="file" name="admin_pp" required class="box">

         <div class="terms-container">
             <input type="checkbox" id="terms" name="terms" required>
             <label for="terms">I agree to the <a href="terms.php" target="_blank">Terms and Conditions</a></label>
         </div>

         <input type="submit" name="submit" value="register now" class="btn">
         <p>Already have an account? <a href="admin_login.php">Login now</a></p>
      </form>
   </div>
</body>
</html>
