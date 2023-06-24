<header class="header">
   <div class="flex">
      <a href="admin_page.php" class="logo">Admin &nbsp;<span>Panel</span></a>
      <nav class="navbar">
         <a href="admin_page.php">Home</a>
         <a href="admin_products.php">Products</a>
         <a href="admin_orders.php">Orders</a>
         <div class="dropdown">
            <button class="dropbtn">Users</button>
            <div class="dropdown-content">
               <a href="admin_users-table.php">Admin</a>
               <a href="users_table.php">Normal Users</a>
            </div>
         </div>
         <a href="admin_contacts.php">Messages</a>
         <a href="summary_report.php">Order Summary</a>
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
