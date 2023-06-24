<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

// Fetch orders from the database
$select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
$orders = array();
if (mysqli_num_rows($select_orders) > 0) {
   while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
      $orders[] = $fetch_orders;
   }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Order Summary</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

   <style>
      /* Styles for the orders table */


      /* Additional styles for the overall layout */
      /* ... */
   </style>

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="orders">
      <h1 class="title">Placed Orders Summary</h1>

      <?php
      $statusOrders = array();
      if (!empty($orders)) {
         // Group orders by status
         foreach ($orders as $order) {
            $statusOrders[$order['payment_status']][] = $order;
         }
      }

      if (!empty($statusOrders)) {
         foreach ($statusOrders as $status => $orders) {
      ?>
            <div class="status-section">
               <div class="box-container">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>User ID</th>
                           <th>Placed on</th>
                           <th>Name</th>
                           <th>Number</th>
                           <th>Email</th>
                           <th>Address</th>
                           <th>Total Products</th>
                           <th>Total Price</th>
                           <th>Payment Method</th>
                           <th>Status</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($orders as $order) { ?>
                           <tr>
                              <td><?php echo $order['user_id']; ?></td>
                              <td><?php echo $order['placed_on']; ?></td>
                              <td><?php echo $order['name']; ?></td>
                              <td><?php echo $order['number']; ?></td>
                              <td><?php echo $order['email']; ?></td>
                              <td><?php echo $order['address']; ?></td>
                              <td><?php echo $order['total_products']; ?></td>
                              <td>₱<?php echo $order['total_price']; ?></td>
                              <td><?php echo $order['method']; ?></td>
                              <td><?php echo $order['payment_status']; ?></td>
                           </tr>
                        <?php } ?>
                     </tbody>
                  </table>
               </div>
            </div>
         <?php
         }
      } else {
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>

   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>
