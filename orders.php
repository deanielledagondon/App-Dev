<?php

include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
   // If not, log them in using the guest user account
   $guest_user_id = 0; // Set the guest user ID
   $_SESSION['user_id'] = $guest_user_id; // Set the session user ID
}
$user_id = $_SESSION['user_id'];

if (isset($_GET['cancel_order'])) {
   $cancel_order_id = $_GET['cancel_order'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = 'Cancelled' WHERE id = '$cancel_order_id'") or die('query failed');
   $message[] = 'Order has been cancelled!';
}

if (isset($_GET['confirm_payment'])) {
    $confirm_payment_id = $_GET['confirm_payment'];
    mysqli_query($conn, "UPDATE `orders` SET payment_status = 'Paid' WHERE id = '$confirm_payment_id'") or die('query failed');
    $message[] = 'Payment has been confirmed!';
 }

if(isset($_GET['delivered_order'])) {
   $completed_order_id = $_GET['delivered_order'];
   mysqli_query ($conn, "UPDATE `orders` SET delivery_status = 'Delivered' WHERE id = '$delivered_order_id'") or die('query failed');
   $message[] = 'Order has been delivered!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Your orders</h3>
   <p> <a href="home.php">Home</a> / Orders </p>
</div>

<section class="placed-orders">

   <h1 class="title">Placed orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name: <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number: <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email: <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address: <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Payment Method: <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Orders: <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total Price: <span>₱<?php echo $fetch_orders['total_price']; ?></span> </p>
         <p> Order Status: <span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         <p> Delivery Status: <span style="color:<?php if($fetch_orders['delivery_status'] == 'Pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['delivery_status']; ?></span> </p>
         <?php
            if ($fetch_orders['payment_status'] == 'Pending') {
               $cancelLink = "?cancel_order=" . $fetch_orders['id'];
               $confirmLink = "?confirm_payment=" . $fetch_orders['id'];
         ?>
            <a href="<?php echo $cancelLink; ?>" class="option-btn">Cancel Order</a>
            <a href="<?php echo $confirmLink; ?>" class="option-btn">Confirm Payment</a>
         <?php
            } elseif ($fetch_orders['payment_status'] == 'Paid') {
               $cancelLink = "?cancel_order=" . $fetch_orders['id'];
         ?>
            <a href="<?php echo $cancelLink; ?>" class="option-btn">Cancel Order</a>
         <?php
            }
         ?>

      </div>
      <?php
         }
      } else {
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
