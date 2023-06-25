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

   if ($table == 'admins') {
      mysqli_query($conn, "DELETE FROM `admins` WHERE id = '$delete_id'") or die('query failed');
      mysqli_query($conn, "SET @num := 0");
      mysqli_query($conn, "UPDATE admins SET id = @num := (@num+1)");
      mysqli_query($conn, "ALTER TABLE admins AUTO_INCREMENT = 1");
   }

   header('location: admin_users-table.php');
   exit();
}

// Check if the admins table is empty
$noAdmins = true;
$select_admins = mysqli_query($conn, "SELECT * FROM `admins` WHERE user_type = 'admin'") or die('query failed');
if (mysqli_num_rows($select_admins) > 0) {
   $noAdmins = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admins</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">
   <h1 class="title">Admin Accounts</h1>

   <?php
   if ($noAdmins) {
      echo '<p class="empty">There are no admin accounts as of the moment.</p>';
   } else {
   ?>
      <table class="table">
         <thead>
            <tr>
               <th>User ID</th>
               <th>Fullname</th>
               <th>Username</th>
               <th>Email</th>
               <th>Phone No.</th>
               <th>Position</th>
               <th>Monthly Salary</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $select_admins = mysqli_query($conn, "SELECT * FROM `admins` WHERE user_type = 'admin'") or die('query failed');
            while ($fetch_admins = mysqli_fetch_assoc($select_admins)) {
               $fullname = $fetch_admins['firstName'] . ' ' . $fetch_admins['middleInitial'] . ' ' . $fetch_admins['lastName'];
            ?>
               <tr>
                  <td><?php echo $fetch_admins['id']; ?></td>
                  <td><?php echo $fullname; ?></td>
                  <td><?php echo $fetch_admins['username']; ?></td>
                  <td><?php echo $fetch_admins['email']; ?></td>
                  <td><?php echo $fetch_admins['phoneNum']; ?></td>
                  <td><?php echo $fetch_admins['position']; ?></td>
                  <td><?php echo $fetch_admins['monthlySalary']; ?></td>
                  <td>
                     <a href="edit_admin-profile.php?id=<?php echo $fetch_admins['id']; ?>" onclick="return confirm('Update information?');" class="update-btn">Update user</a>
                     <a href="admin_users-table.php?delete=<?php echo $fetch_admins['id']; ?>&table=admins" onclick="return confirm('Delete this user?');" class="delete-btn">Delete user</a>
                  </td>
               </tr>
            <?php
            }
            ?>
         </tbody>
      </table>
   <?php
   }
   ?>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
