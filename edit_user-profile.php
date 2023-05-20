<?php

include 'config.php';
session_start();


$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if (isset($_SESSION['user_email'])) {
  $email = $_SESSION['user_email'];

  $findresult = mysqli_query($conn, "SELECT * FROM admins WHERE email= '$email'");

  if ($res = mysqli_fetch_array($findresult)) {

  $username = $res['username'];
  $firstName = $res['firstName'];
  $lastName = $res['lastName'];
  $middleInitial = $res['middleInitial'];
  $age = $res['age'];
  $address = $res['address'];
  $oldname = $res['oldname'];
  $pp = $res['pp'];
  if (empty($pp)) {
    $pp = null;
}
}
  } else {
    header('location:admin_login.php');
      exit();
}


 ?> 
 <!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="style.css">
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

    $folder='uploads/';
    $file_name = $_FILES['pp']['name'];
    $file_tmp = $_FILES['pp']['tmp_name'];
    $file_size = $_FILES['pp']['size'];
    $file_type = $_FILES['pp']['type'];
    $file_name_array = explode(".", $file_name); 
    $extension = end($file_name_array);
    $pp ='profile_'.rand() . '.' . $extension;

    $file = isset($_FILES['pp']) ? $_FILES['pp']['tmp_name'] : '';


  if ($_FILES["pp"]["size"] >1000000) {
   $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size .';
 
}
 if($file != "")
  {
if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG") {
    
   $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
}
}

$sql="SELECT * from users where name='$username'";
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
    if(!isset($error)){ 
          if($file!= "")
          {
            $stmt = mysqli_query($conn,"SELECT pp FROM  users WHERE email='$email'");
            $row = mysqli_fetch_array($stmt); 
            $deleteimage=$row['pp'];
            unlink($folder.$deleteimage);
            move_uploaded_file($file, $folder . $pp); 
            mysqli_query($conn,"UPDATE users SET pp='$pp' WHERE email='$email'");
          }
           $result = mysqli_query($conn,"UPDATE users SET username='username' WHERE email='$email'");
           if ($result) {
            header("location:edit_admin-profile.php?message=success");
            exit();
          } else {
            $error[] = 'Something went wrong';
          }
        }
      }

        if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
}


        ?> 
     <form method="post" enctype='multipart/form-data' action="">
          <div class="row">
            <div class="col"></div>
           <div class="col-6"> 
            <center>
            <?php if($pp==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="uploads/'.$pp.'" style="height:80px;width:auto;border-radius:50%;">';}?> 
                <div class="form-group">
                <label>Change Image &#8595;</label>
                <input class="form-control" type="file" name="pp" style="width:100%;" >
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
                <label>Username</label>
            </div>
             <div class="col">
                <input type="text" name="username" value="<?php echo $username;?>" class="form-control">
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