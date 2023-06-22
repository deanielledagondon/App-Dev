<?php
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
   $product_id = $_GET['id'];

   $select_product_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id'") or die('query failed');
   $fetch_product = mysqli_fetch_assoc($select_product_query);

   if ($fetch_product) {
      $product_name = $fetch_product['name'];
      $product_price = $fetch_product['price'];
      $product_image = $fetch_product['image'];
      $product_description = $fetch_product['description'];
      $product_review = $fetch_product['review'];
   } else {
      // Product not found, redirect or display an error message
      header('Location: admin_products.php');
      exit();
   }
} else {
   // No product ID provided, redirect or display an error message
   header('Location: admin_products.php');
   exit();
}
<<<<<<< HEAD

if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_description = $_POST['description'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'Already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart` (user_id, name, price, quantity, image) VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'Product added to cart!';
   }
}

if(isset($_POST['submit_review'])){
   $review = $_POST['review'];

   $user_query = mysqli_query($conn, "SELECT username FROM `users` WHERE id = '$user_id'") or die('query failed');
   $user_data = mysqli_fetch_assoc($user_query);
   $username = $user_data['username'];

   $updated_review = "[$username] " . $review;

   mysqli_query($conn, "UPDATE `products` SET review = CONCAT(IFNULL(review,''), '$updated_review') WHERE id = '$product_id'") or die('query failed');
   $product_review = $product_review . $updated_review;
=======
if (isset($_POST['back'])) {
   header('Location: shop.php');
   exit();
>>>>>>> 9f91c7c525bb5fd9ac18cc3927a6a50b12b047b0
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>


<div class="product-container">
   <div class="product-container-image">
      <div class="product-image">
         <div class="productimage-box">
            <img src="uploaded_img/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
         </div>
      </div>
   </div>
   <div class="product-container-details">
      <div class="product-details">
         <div class="product-box">
            <div class="product-name"><?php echo $product_name; ?></div>
            <div class="product-price">Price: ₱<?php echo $product_price; ?></div>
            <div class="product-description"><?php echo $product_description; ?></div>
            <div class="product-review-section">
               <h3>Add a Review</h3>
               <form action="" method="post">
                  <textarea name="review" rows="4" cols="50"></textarea>
                  <input type="submit" value="Submit" name="submit_review" class="btn">
               </form>
               <?php if (!empty($product_review)) { ?>
               <div class="review-section">
                  <h3>Reviews</h3>
                  <?php
                  $reviews = explode("\n", $product_review);
                  foreach ($reviews as $review) {
                     echo '<p>' . nl2br($review) . '</p>';
                  }
                  ?>
               </div>
               <?php } ?>
            </div>
            <div class="product-actions">
               <form action="" method="post" class="box">
                  <input type="number" min="1" name="product_quantity" value="1" class="qty">
                  <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                  <input type="hidden" name="description" value="<?php echo $product_description; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $product_image; ?>">
                  <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<h2 style="text-align: center; margin-top: 2rem;"><br>--------YOU MAY ALSO LIKE--------<br></h2>

<section class="show-products">
   <section class="products">
      <div class="box-container">
         <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="" method="post" class="box">
            <a href="viewshop.php?id=<?php echo $fetch_products['id']; ?>">
               <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" height="100" width="260">
               <div class="name"><?php echo $fetch_products['name']; ?></div>
               <div class="price">₱<?php echo $fetch_products['price']; ?></div>
               <input type="number" min="1" name="product_quantity" value="1" class="qty">
               <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
               <input type="hidden" name="description" value="<?php echo $fetch_products['description']; ?>">
               <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
               <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </a>
         </form>
         <?php
               }
            } else {
               echo '<p class="empty">No products added yet!</p>';
            }
         ?>
      </div>
   </section>
</section>

<?php include 'footer.php'; ?>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>
</body>
</html>
