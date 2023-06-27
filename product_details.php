<?php
session_start(); // Add this line to start the session

include 'config.php';

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
   <link rel="stylesheet" href="css/admin_product.css">
</head>
<body>
   <h1 class="title">Product Details</h1>


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
               <div class="product-actions">
                  <a href="admin_products.php?update=<?php echo $product_id; ?>" class="update-btn">Update</a>
                  <a href="admin_products.php?delete=<?php echo $product_id; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
               </div>
               <div class="reviews"><br>
                <h3> Reviews:</h3>
                  <div class="product-review"><?php echo $product_review; ?></div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <section class="show-products">
      <div class="box-container">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <div class="box">
                  <a href="product_details.php?id=<?php echo $fetch_products['id']; ?>">
                     <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" height="100" width="260">
                  </a>
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="price">₱<?php echo $fetch_products['price']; ?>/- </div>
                  <br>
                  <div class="product-actions">
                     <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="update-btn">Update</a>
                     <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
         ?>
      </div>
   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
</body>
</html>
