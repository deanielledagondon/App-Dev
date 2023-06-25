<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Paid Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="orders">

      <?php
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'Paid'") or die('query failed');
      ?>

      <?php if (mysqli_num_rows($select_orders) > 0) { ?>
         <table class="table">
            <thead>
               <tr>
                  <th>User ID</th>
                  <th>Placed On</th>
                  <th>Name</th>
                  <th>Number</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Total Products</th>
                  <th>Total Price</th>
                  <th>Payment Method</th>
                  <th>Order Status</th>
                  <th>Delivery Status</th>
               </tr>
            </thead>
            <tbody>
               <?php
               while ($order = mysqli_fetch_assoc($select_orders)) {
                  $user_id = $order['user_id'];
                  $placed_on = $order['placed_on'];
                  $name = $order['name'];
                  $number = $order['number'];
                  $email = $order['email'];
                  $address = $order['address'];
                  $total_products = $order['total_products'];
                  $total_price = $order['total_price'];
                  $payment_method = $order['method'];
                  $payment_status = $order['payment_status'];
                  $delivery_status = $order['delivery_status'];
               ?>
                  <tr>
                     <td><?php echo $user_id; ?></td>
                     <td><?php echo $placed_on; ?></td>
                     <td><?php echo $name; ?></td>
                     <td><?php echo $number; ?></td>
                     <td><?php echo $email; ?></td>
                     <td><?php echo $address; ?></td>
                     <td><?php echo $total_products; ?></td>
                     <td>₱<?php echo $total_price; ?></td>
                     <td><?php echo $payment_method; ?></td>
                     <td><?php echo $payment_status; ?></td>
                     <td><?php echo $delivery_status; ?></td>
                  </tr>
               <?php
               }
               ?>
            </tbody>
         </table>
      <?php } else { ?>
         <p class="empty">There are no paid orders.</p>
      <?php } ?>

   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>
