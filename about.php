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
         <p>Welcome to MakoTek, the leading IT shop that caters to all your computing and gaming needs. At MakoTek, we are dedicated to providing you with the best deals and affordable prices, making top-notch technology accessible to all.
         <p>Conveniently located at C.L. Fule Arcade, M. Basa Street, Cagayan de Oro City, Makotek invites you to step into our world of technology. Explore our showroom, experience the latest innovations, and immerse yourself in the possibilities of the digital realm. 
         <p>Join us at MakoTek and let us empower you with the best in technology, affordability, and exceptional customer service.
      </p>
         <a href="contact.php" class="btn">Contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <p>I highly recommend Makotek for their exceptional customer service and top-notch quality products</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Lisa Smith</h3>
      </div>

      <div class="box">
         <p>As a tech enthusiast, I was thrilled with the wide range of computer peripherals available at MegaGear, and their knowledgeable staff helped me find the perfect components</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Michael Johnson</h3>
      </div>

      <div class="box">
         <p>GadgetWorld exceeded my expectations with their speedy delivery and competitive prices, making them my go-to store for computer accessories</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Sarah Thompson</h3>
      </div>

      <div class="box">
         <p>The professionalism and expertise demonstrated by the team at ByteBazaar made my shopping experience for computer peripherals both enjoyable and informative</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>David Wilson</h3>
         </div>

         <div class="box">
         <p>With their user-friendly website and impressive selection, PC Haven is definitely the ultimate destination for anyone in need of reliable computer peripherals</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Emily Brown</h3>
         </div>

         <div class="box">
         <p>I've never been disappointed with the quality and durability of the products I purchased from ByteTech, making them my trusted choice for computer peripherals</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Robert Davis</h3>
         </div>



   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>