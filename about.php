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
         <p>Welcome to MakoTek, the leading IT shop that caters to all your computing and gaming needs. We take pride in offering a diverse range of high-quality computers and gaming peripherals, ensuring that you stay ahead in the digital world. At MakoTek, we are dedicated to providing you with the best deals and affordable prices, making top-notch technology accessible to all.
         <p>Conveniently located at Ground Floor, LK Building, 5 Rizal St, Gaston Park, Cagayan de Oro City, MakoTek invites you to step into our world of technology. Explore our showroom, experience the latest innovations, and immerse yourself in the possibilities of the digital realm. Our friendly staff will be delighted to assist you in finding the perfect solution that matches your needs and budget.
         <p>"Name it and we make IT happen at MakoTek!"
         <p>At MakoTek, we're not just a technology provider; we're your partner in unlocking the full potential of modern computing. Whether you're a professional, a gamer, or an enthusiast, we are committed to delivering unparalleled products and services that elevate your experience. Join us at MakoTek and let us empower you with the best in technology, affordability, and exceptional customer service.
      </p>
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

      <div class="box">
         <p>10/10 Super grateful to Makoyek Team for this affordable and superb PC Build</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Nicole Bardilas</h3>
         </div>

         <div class="box">
         <p>I just found their page at the same day I bought the set. Super sulit, computer performance wise,  bundle set wise, price is just right and has freebies. It's all in already.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Soon Yi</h3>
         </div>

         <div class="box">
         <p>Very responsive to queries. Even accomodated my request to buy on a Sunday</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Alex</h3>
         </div>



   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>