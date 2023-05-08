<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['user_id'])) {
   // If not, log them in using the guest user account
   $guest_user_id = 0; // Set the guest user ID
   $_SESSION['user_id'] = $guest_user_id; // Set the session user ID
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>About Us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.webp" alt="">
      </div>

      <div class="content">
         <h3>Why choose us?</h3>
         <p>MakoTek is an IT shop that aims to provide high-quality computers and gaming peripherals at reasonable prices. Our goal is to cater to everyone's needs, from casual users to businesses requiring enterprise-level solutions. We take pride in our ability to build customized PC setups that are tailored to your budget and preferences.
         <p>Our shop is located on the Ground Floor of LK Building, which is situated on 5 Rizal St in Gaston Park, Cagayan de Oro City. We have a team of knowledgeable and skilled technicians who are dedicated to providing the best solutions and services to our customers.</p>
         <a href="contact.php" class="btn">Contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <p>Thank you Makotek I just bought my computer set na sulit kaayo ang price plus grabe ka accomodating. So happy Excellent customer service. Highly recommend gyud.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Sandra</h3>
      </div>

      <div class="box">
         <p>Thank you kaayo sa pag build up computer mga boss solid kaayo akong money thank you.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Benidick</h3>
      </div>

      <div class="box">
         <p>Thank you Makotek! Very responsive and accomodating team Sulit pa build diri</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Christian</h3>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>