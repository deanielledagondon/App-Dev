<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Admin &nbsp;<span>Panel</span></a>
      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders Placed</a>
         <div class="dropdown">
            <button class="dropbtn">Users</button>
            <div class="dropdown-content">
               <a href="admin_users-table.php">Admin</a>
               <a href="users_table.php">Normal Users</a>
            </div>
         </div>
         <a href="admin_contacts.php">Messages</a>
         <div class="dropdown">
            <button class="dropbtn">Payment</button>
            <div class="dropdown-content">
               <a href="pending_order.php?status=Pending">Pending</a>
               <a href="paid_order.php?status=Paid">Paid</a>
               <a href="cancelled_order.php?status=Cancelled">Cancelled</a>
            </div>
         </div>
         <div class="dropdown">
            <button class="dropbtn">Delivery</button>
            <div class="dropdown-content">
               <a href="pending_delivery.php?delivery=Pending">Pending</a>
               <a href="in_transit-delivery.php?delivery=In Transit">In Transit</a>
               <a href="completed_delivery.php?delivery=Delivered">Delivered</a>
               <a href="cancelled_deliv.php?status=Cancelled">Cancelled</a>

            </div>
         </div>
      </nav>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box">
         <p> Username: <span><?php echo $_SESSION['admin_username']; ?></span></p>
         <p> Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
      </div>
   </div>
</header>
