<?php
include 'config.php';

$message = array(); // Initialize the message array

if(isset($_POST['submit'])){
   $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
   $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
   $middleInitial = mysqli_real_escape_string($conn, $_POST['middleInitial']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $phoneNum = mysqli_real_escape_string($conn, $_POST['phoneNum']);
   $pp = $_FILES['pp'] ?? null;

   $terms = isset($_POST['terms']) ? true : false; // Check if the "terms" checkbox is checked


   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'") or die('query failed');

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
         if ($pp !== null && $pp['error'] === UPLOAD_ERR_OK && $pp['size'] > 0) {
            $file_name = $pp['name'];
            $file_tmp = $pp['tmp_name'];
            $file_size = $pp['size'];
            $file_type = $pp['type'];
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
                  mysqli_query($conn, "INSERT INTO `users` (firstName, lastName, middleInitial, username, email, password, age, address, phoneNum, pp) VALUES ('$firstName', '$lastName', '$middleInitial',  '$username', '$email', '$password', '$age', '$address', '$phoneNum', '$file_path')") or die('query failed');
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
   </style>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
   #bg_vid {
      width: 100vw;
      height: 100vh;
      object-fit: cover;
      position: fixed;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      z-index: -1;
 }
      </style>
</head>
<body>
<video autoplay muted loop id = "bg_vid">
<source src  ="makotek_bg.mp4" type = "video/mp4">
</video>



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
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required class="box">
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required class="box">
            <input type="text" id="middleInitial" name="middleInitial" placeholder="M.I" required class="box">
         </div>
         <div class="row-container">
            <input type="text" id="username" name="username" placeholder="Username" required class="box">
            <input type="email" id="email" name="email" placeholder="Email" required class="box">
         </div>
         <div class="row-container">
            <input type="password" id="password" name="password" placeholder="Password" required class="box">
            <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required class="box">
         </div>
         <div class="row-container">
         <input type="number" id="age" name="age" placeholder="Age" required class="box">
         <input type="tel" id="phoneNum" name="phoneNum" placeholder="Phone No." required class="box">
         </div>
         <input type="text" id="address" name="address" placeholder="Address" required class="box">
         <input type="file" id="pp" name="pp" required class="box">

         <div class="terms-container">
             <input type="checkbox" id="terms" name="terms" required>
             <label for="terms">I agree to the <a href="terms.php" target="_blank">Terms and Conditions</a></label>
         </div>


         <input type="submit" id="register" name="submit" value="register" class="btn">
         <p>Already have an account? <a href="login.php">Login now</a></p>
      </form>
   </div>
</body>
</html>