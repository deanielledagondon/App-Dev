<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}
else if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `admins` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title">User Accounts</h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <span><img src="<?php echo $fetch_users['pp']; ?>" class="profile-img"></span>
         <p>User ID: <span><?php echo $fetch_users['id']; ?></span> </p>
         <p>Username: <span><?php echo $fetch_users['username']; ?></span> </p>
         <p>Email: <span><?php echo $fetch_users['email']; ?></span> </p>
         <p>User Type: <span style="color:<?php if($fetch_users['user_type'] == 'user'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>

         
         
         <a href="edit_user-profile.php?id=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Update information?');" class="btn btn-primary">Update user</a>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete user</a>
      </div>
      <?php
         }
      ?>
   </div>

</section>

<section class="users">
<h1 class="title">Admin Accounts</h1>

   <div class="box-container">
      <?php
         $select_admins = mysqli_query($conn, "SELECT * FROM `admins`") or die('query failed');
         while($fetch_admins = mysqli_fetch_assoc($select_admins)){
      ?>
      <div class="box">
      <span><img src="<?php echo $fetch_admins['admin_pp']; ?>" class="profile-img"></span>
         <p>User ID: <span><?php echo $fetch_admins['id']; ?></span> </p>
         <p>Username: <span><?php echo $fetch_admins['username']; ?></span> </p>
         <p>Email: <span><?php echo $fetch_admins['email']; ?></span> </p>
         <p>User Type: <span style="color:<?php if($fetch_admins['user_type'] == 'admin'){ echo 'var(--blue)'; } ?>"><?php echo $fetch_admins['user_type']; ?></span> </p>
         <p>Position: <span><?php echo $fetch_admins['position']; ?></span> </p>
         <p>Monthly Salary: <span><?php echo $fetch_admins['monthlySalary']; ?></span> </p>

         <a href="edit_admin-profile.php?id=<?php echo $fetch_admins['id']; ?>" onclick="return confirm('Update information?');" class="btn btn-primary">Update user</a>
         <a href="admin_users.php?delete=<?php echo $fetch_admins['id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete user</a>
      </div>
      <?php
         }
      ?>
   </div>

</section>


<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>