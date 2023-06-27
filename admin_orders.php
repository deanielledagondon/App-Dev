<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_POST['update_order'])) {
   $order_update_id = $_POST['order_id'];

   if (isset($_POST['update_delivery_status'])) {
      $update_delivery = $_POST['update_delivery_status'];
      if (!empty($update_delivery)) {
         mysqli_query($conn, "UPDATE `orders` SET delivery_status = '$update_delivery' WHERE id = '$order_update_id'") or die('query failed');
         $message[] = 'Delivery status has been updated!';
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

if (isset($_POST['save_remarks'])) {
   $order_id = $_POST['order_id'];
   $remarks = $_POST['remarks'];

   if (!empty($remarks)) {
      mysqli_query($conn, "UPDATE `orders` SET remarks = '$remarks' WHERE id = '$order_id'") or die('query failed');
      $message[] = 'Remarks have been saved!';
   }
   
}



// Check if there are no orders
$noOrders = true;
$select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
if (mysqli_num_rows($select_orders) > 0) {
   $noOrders = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders Placed</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
   <?php include 'admin_header.php'; ?>
   

   <section class="orders">
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

      <h1 class="title">Orders Placed</h1>

      <?php
      if ($noOrders) {
         echo '<p class="empty">There are no orders as of the moment.</p>';
      } else {
         $select_orders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY placed_on ASC") or die('query failed');
         $orders_by_payment = array();

         while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            $payment_status = $fetch_orders['payment_status'];
            $date = date('F j, Y', strtotime($fetch_orders['placed_on']));
            if (!isset($orders_by_payment[$payment_status])) {
               $orders_by_payment[$payment_status] = array();
            }
            if (!isset($orders_by_payment[$payment_status][$date])) {
               $orders_by_payment[$payment_status][$date] = array();
            }
            $orders_by_payment[$payment_status][$date][] = $fetch_orders;
         }

         foreach ($orders_by_payment as $payment_status => $orders_by_date) {
            echo '<h2 class="payment-status">' . $payment_status . '</h2>';

            foreach ($orders_by_date as $date => $orders) {
               echo '<h3 class="order-date">' . $date . '</h3>';
      ?>

               <table class="table">
                  <thead>
                     <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Total Products</th>
                        <th>Total Price</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     foreach ($orders as $order) {
                        $user_id = $order['user_id'];
                        $name = $order['name'];
                        $number = $order['number'];
                        $email = $order['email'];
                        $address = $order['address'];
                        $total_products = $order['total_products'];
                        $total_price = $order['total_price'];
                        $payment_method = $order['method'];
                        $payment_status = $order['payment_status'];
                        $delivery_status = $order['delivery_status'];
                        $remarks = $order['remarks'];
                     ?>
                        <tr>
                           <td><?php echo $user_id; ?></td>
                           <td><?php echo $name; ?></td>
                           <td><?php echo $number; ?></td>
                           <td><?php echo $email; ?></td>
                           <td><?php echo $address; ?></td>
                           <td><?php echo $total_products; ?></td>
                           <td>₱<?php echo $total_price; ?></td>
                           <td><?php echo $payment_method; ?></td>
                           <td><?php echo $payment_status; ?></td>
                           <td>
                              <form action="" method="post">
                                 <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                 <select name="update_delivery_status">
                                    <option value="Pending" <?php if ($delivery_status == 'Pending') echo 'selected'; ?>>Pending</option>
                                    <option value="In Transit" <?php if ($delivery_status == 'In Transit') echo 'selected'; ?>>In Transit</option>
                                    <option value="Delivered" <?php if ($delivery_status == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                    <option value="Cancelled" <?php if ($delivery_status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                 </select>
                                 <input type="submit" value="Update" name="update_order" class="update-btn">
                              </form>
                           </td>
                           <td>
                              <form action="" method="post">
                                 <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                 <textarea name="remarks"><?php echo $remarks; ?></textarea>
                                 <input type="submit" value="Save" name="save_remarks" class="option-btn">
                              </form>
                           </td>
                           <td>
                              <a href="admin_orders.php?delete=<?php echo $order['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
                           </td>
                        </tr>
                     <?php
                     }
                     ?>
                  </tbody>
               </table>
      <?php
            }
         }
      }
      ?>
   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
</body>

</html>
