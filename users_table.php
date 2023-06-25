<?php
include 'config.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
   header('location: admin_login.php');
   exit();
}

$admin_id = $_SESSION['admin_id'];

if (isset($_GET['delete']) && isset($_GET['table'])) {
   $delete_id = $_GET['delete'];
   $table = $_GET['table'];

   if ($table == 'users') {
      mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
      mysqli_query($conn, "SET @num := 0");
      mysqli_query($conn, "UPDATE users SET id = @num := (@num+1)");
      mysqli_query($conn, "ALTER TABLE users AUTO_INCREMENT = 1");
   } 
   header('location: admin_users-table.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Normal Users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">
   <h1 class="title">User Accounts</h1>

   <table class="table">
      <thead>
         <tr>
            <th>User ID</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Address</th>
            <th>Actions</th>
         </tr>
      </thead>
      <tbody>
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while ($fetch_users = mysqli_fetch_assoc($select_users)) {
            if ($fetch_users['user_type'] == 'user') {
               $fullname = $fetch_users['firstName'] . ' ' . $fetch_users['middleInitial'] . ' ' . $fetch_users['lastName'];
               ?>
               <tr>
                     <td><?php echo $fetch_users['id']; ?></td>
                     <td><?php echo $fullname; ?></td>
                     <td><?php echo $fetch_users['username']; ?></td>
                     <td><?php echo $fetch_users['email']; ?></td>
                     <td><?php echo $fetch_users['phoneNum']; ?></td>
                     <td><?php echo $fetch_users['address']; ?></td>
                     <td>
                        <a href="admin-edit-user.php?id=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Update information?');" class="update-btn">Update user</a>
                        <a href="users_table.php?delete=<?php echo $fetch_users['id']; ?>&table=users" onclick="return confirm('Delete this user?');" class="delete-btn">Delete user</a>
                     </td>
               </tr>
               <?php
            }
         }
         ?>

      </tbody>
   </table>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
