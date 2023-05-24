<?php
include 'config.php';
session_start();

if(!isset($_SESSION["admin_id"])) {
    header("location: admin_login.php"); 
}

$email = $_SESSION["admin_email"];
$findresult = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");

if($res = mysqli_fetch_array($findresult)) {
    $firstName = $res['firstName']; 
    $lastName = $res['lastName'];
    $middleInitial = $res['middleInitial'];
    $age = $res['age'];
    $address = $res['address'];
    $position = $res['position'];
    $monthlySalary = $res['monthlySalary'];
    $image = $res['admin_pp'];
}
?> 

<!DOCTYPE html>
<html>
<head>
    <title>My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="login_form">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-6"> 
                            <?php if(isset($_GET['profile_updated'])) { ?>
                                <div class="successmsg">Profile saved.</div>
                            <?php } ?>
                            <?php if(isset($_GET['password_updated'])) { ?>
                                <div class="successmsg">Password has been changed.</div>
                            <?php } ?>
                            <center>
                                <?php if($image == NULL) {
                                    echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                                } else {
                                    echo '<img src="uploads/' . $image . '" style="height: 80px; width: auto; border-radius: 50%;">';
                                }?> 
                                <p>Welcome! <span style="color: #33CC00"><?php echo $username; ?></span></p>
                            </center>
                        </div>
                    </div>

                    <form>
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" value="<?php echo $fname; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" value="<?php echo $lname; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="middleInitial">Middle Initial:</label>
                            <input type="text" class="form-control" id="middleInitial" value="<?php echo $mi; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control" id="age" value="<?php echo $age; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" value="<?php echo $address; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" class="form-control" id="position" value="<?php echo $position; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="monthlySalary">Monthly Salary:</label>
                            <input type="text" class="form-control" id="monthlySalary" value="<?php echo $salary; ?>" readonly>
                            <div class="form-group">
                            <a href="edit_admin-profile.php" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>