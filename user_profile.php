<?php
include 'config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
}

$email = $_SESSION["user_email"];
$findresult = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if ($res = mysqli_fetch_array($findresult)) {
    $firstName = $res['firstName'];
    $lastName = $res['lastName'];
    $middleInitial = $res['middleInitial'];
    $username = $res['username'];
    $email = $res['email'];
    $age = $res['age'];
    $address = $res['address'];
    $phoneNum = $res['phoneNum'];
    $pp = $res['pp'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My Account</title>
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
                <div class="login_form">

                    <div class="row">
                        <div class="col"></div>
                        <div class="col-6">
                            <?php if (isset($_GET['profile_updated'])) { ?>
                                <div class="successmsg">Profile saved ..</div>
                            <?php } ?>
                            <?php if (isset($_GET['password_updated'])) { ?>
                                <div class="successmsg">Password has been changed...</div>
                            <?php } ?>
                            <center>
                                <p> Welcome! <span style="color:#33CC00"><?php echo $username; ?></span> </p>
                                <span><img src="<?php echo $pp; ?>" class="profile-img"></span>
                            </center>

                        </div>
                    </div>


                    <div>
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" value="<?php echo $firstName; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" value="<?php echo $lastName; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="middleInitial">Middle Initial:</label>
                            <input type="text" class="form-control" id="middleInitial"
                                value="<?php echo $middleInitial; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="age">Username:</label>
                            <input type="text" class="form-control" id="username" value="<?php echo $username; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="age">Email:</label>
                            <input type="text" class="form-control" id="email" value="<?php echo $email; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control" id="age" value="<?php echo $age; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" value="<?php echo $address; ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Phone Number:</label>
                            <input type="text" class="form-control" id="address" value="<?php echo $phoneNum; ?>"
                                readonly>
                        </div>

                        <div class="form-group">
                            <a href="user_edit.php" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
