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
if (isset($_POST['back'])) {
   header('Location: shop.php');
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
<?php include 'header_viewshop.php'; ?>

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
                  <form action="" method="post" class="box">
                     <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $product_image; ?>">
                     <input type="submit" value="Add to Cart" name="add_to_cart" a href = "shop.php" class="btn">
                     <button type= "submit" name = "back" class="btn btn-primary"  a href = "shop.php">Back</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <h2 style="text-align: center; margin-top: 2rem;"><br>--------YOU MAY ALSO LIKE-------- <br><br><br></h2>

   <section class="show-products">
      <div class="box-container">
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
         ?>
               <form action="" method="post" class="box">
                  <a href="viewshop.php?id=<?php echo $fetch_products['id']; ?>">
                     <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" height="100" width="260">
                  </a>
                  <div class="name"><?php echo $fetch_products['name']; ?></div>
                  <div class="price">₱<?php echo $fetch_products['price']; ?></div>
                  <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                  <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
               </form>
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
