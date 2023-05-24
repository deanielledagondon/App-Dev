<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

if (isset($_SESSION['admin_email'])) {
  $email = $_SESSION['admin_email'];

  $findresult = mysqli_query($conn, "SELECT * FROM admins WHERE email= '$email'");

  if ($res = mysqli_fetch_array($findresult)) {
    $username = $res['username'];
    $firstName = $res['firstName'];
    $lastName = $res['lastName'];
    $middleInitial = $res['middleInitial'];
    $age = $res['age'];
    $address = $res['address'];
    $position = $res['position'];
    $monthlySalary = $res['monthlySalary'];
    $oldname = $res['oldname'];
    $admin_pp = $res['admin_pp'];
  }
} else {
  // Handle the case when 'email' key is not set in the session
  // You can redirect the user to a login page or perform any other necessary action
  // For example:
  header('location:admin_login.php');
  exit(); // Make sure to exit the script after redirection
}

?>

 <!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
           
     <form action="" method="POST" enctype='multipart/form-data'>
  <div class="login_form">

  <?php 
          if(isset($_POST['update_profile'])){

    $username=$_POST['username'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];  
    $middleInitial=$_POST['middleInitial']; 
    $age=$_POST['age']; 
    $address=$_POST['address']; 
    $position=$_POST['position']; 
    $monthlySalary=$_POST['monthlySalary']; 

    $folder='uploads/';
    $file_name = $_FILES['admin_pp']['name'];
    $file_tmp = $_FILES['admin_pp']['tmp_name'];
    $file_size = $_FILES['admin_pp']['size'];
    $file_type = $_FILES['admin_pp']['type'];
    $file_name_array = explode(".", $file_name); 
    $extension = end($file_name_array);
    $admin_pp ='profile_'.rand() . '.' . $extension;

    $file = isset($_FILES['admin_pp']) ? $_FILES['admin_pp']['tmp_name'] : '';

    
  if ($_FILES["admin_pp"]["size"] >1000000) {
   $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size .';
 
}
 if($file != "")
  {
if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG") {
    
   $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
}
}

$sql="SELECT * from admins where username='$username'";
      $res=mysqli_query($conn,$sql);
   if (mysqli_num_rows($res) > 0) {
$row = mysqli_fetch_assoc($res);

   if($oldname!=$username){
     if($username==$row['username'])
     {
           $error[] ='Name already exists. Create a unique username.';
          } 
   }
}
if (!isset($error)) {
          if($file!= "")
          {
            $stmt = mysqli_query($conn,"SELECT admin_pp FROM  admins WHERE email='$email'");
            $row = mysqli_fetch_array($stmt); 
            $deleteimage=$row['admin_pp'];
            unlink($folder.$deleteimage);
            move_uploaded_file($file, $folder . $admin_pp); 
            mysqli_query($conn,"UPDATE admins SET admin_pp='$admin_pp' WHERE email='$email'");
          }
           $result = mysqli_query($conn,"UPDATE admins SET username ='username' WHERE email='$email'");
           if ($result) {
            header("location:edit_admin-profile.php?message=success");
            exit();
          } else {
            $error[] = 'Something went wrong';
          }
        }
      }

      if (isset($error)) {
        foreach ($error as $error) {
          echo '<p class="errmsg">' . $error . '</p>';
        }
      }
      ?>  

     <form method="post" enctype='multipart/form-data' action="">
          <div class="row">
            <div class="col"></div>
           <div class="col-6"> 
            <center>
            <?php if($admin_pp==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="uploads/'.$admin_pp.'" style="height:80px;width:auto;border-radius:50%;">';}?> 
                <div class="form-group">
                <label>Change Image &#8595;</label>
                <input class="form-control" type="file" name="admin_pp" style="width:100%;" >
            </div>

  </center>
           </div>
            <div class="col"><p><a href="logout.php"><span style="color:red;">Logout</span> </a></p>
         </div>
          </div>

          <div class="form-group">
          <div class="row"> 
            <div class="col-3">
                <label>First Name</label>
            </div>
             <div class="col">
                <input type="text" name="firstName" value="<?php echo $firstName;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Last Name</label>
            </div>
             <div class="col">
                <input type="text" name="lastName" value="<?php echo $lastName;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>M.I</label>
            </div>
             <div class="col">
                <input type="text" name="middleInitial" value="<?php echo $middleInitial;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Username</label>
            </div>
             <div class="col">
                <input type="text" name="username" value="<?php echo $username;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Email</label>
            </div>
             <div class="col">
                <input type="text" name="email" value="<?php echo $email;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Age</label>
            </div>
             <div class="col">
                <input type="text" name="age" value="<?php echo $age;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Address</label>
            </div>
             <div class="col">
                <input type="text" name="address" value="<?php echo $address;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Position</label>
            </div>
             <div class="col">
                <input type="text" name="position" value="<?php echo $position;?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Monthly Salary </label>
            </div>
             <div class="col">
                <input type="text" name="monthlySalary" value="<?php echo $monthlySalary;?>" class="form-control">
            </div>
          </div>
      </div>
           <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
<button  class="btn btn-success" name="update_profile">Save Profile</button>
            </div>
           </div>
       </form>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div> 
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>