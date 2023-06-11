<?php
include 'config.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location:login.php");
    exit();
}

$email = $_SESSION["user_email"];
$findresult = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if (!$findresult) {
    die("Error: " . mysqli_error($conn));
}

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
} else {
    die("Error: User not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedFirstName = $_POST['firstName'];
    $updatedLastName = $_POST['lastName'];
    $updatedMiddleInitial = $_POST['middleInitial'];
    $updatedUsername = $_POST['username'];
    $updatedEmail = $_POST['email'];
    $updatedAge = $_POST['age'];
    $updatedAddress = $_POST['address'];
    $updatedPhoneNum = $_POST['phoneNum'];

    $updatesMade = false; // bolean ni nga part
    if (
        $updatedFirstName !== $firstName ||
        $updatedLastName !== $lastName ||
        $updatedMiddleInitial !== $middleInitial ||
        $updatedUsername !== $username ||
        $updatedEmail !== $email ||
        $updatedAge !== $age ||
        $updatedAddress !== $address ||
        $updatedPhoneNum !== $phoneNum
    ) {
        $updatesMade = true; // if true matic siya sa condition where e update na niya ang mga new data sa forms
    }

    if ($updatesMade) {
        mysqli_query($conn, "UPDATE users SET 
            firstName='$updatedFirstName', 
            lastName='$updatedLastName', 
            middleInitial='$updatedMiddleInitial', 
            username='$updatedUsername', 
            email='$updatedEmail', 
            age='$updatedAge', 
            address='$updatedAddress', 
            phoneNum='$updatedPhoneNum' 
            WHERE email='$email'");

        $_SESSION["user_firstName"] = $updatedFirstName;
        $_SESSION["user_lastName"] = $updatedLastName;
        $_SESSION["user_middleInitial"] = $updatedMiddleInitial;
        $_SESSION["user_username"] = $updatedUsername;
        $_SESSION["user_email"] = $updatedEmail;
        $_SESSION["user_age"] = $updatedAge;
        $_SESSION["user_address"] = $updatedAddress;
        $_SESSION["user_phoneNum"] = $updatedPhoneNum;

        $firstName = $updatedFirstName;
        $lastName = $updatedLastName;
        $middleInitial = $updatedMiddleInitial;
        $username = $updatedUsername;
        $email = $updatedEmail;
        $age = $updatedAge;
        $address = $updatedAddress;
        $phoneNum = $updatedPhoneNum;
    }
   // dire dayun sa image nga part 
    if ($_FILES['profileImage']['name'] != '') {
        $tmpFilePath = $_FILES['profileImage']['tmp_name'];
        $uploadPath = 'uploads/' . $_FILES['profileImage']['name'];

        if (move_uploaded_file($tmpFilePath, $uploadPath)) {
            mysqli_query($conn, "UPDATE users SET pp='$uploadPath' WHERE email='$email'");
            $pp = $uploadPath; 
        } else {
            die("Error: Failed to upload the profile image.");
        }
    }
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
                            <center>
                                <p> Welcome! <span style="color:#33CC00"><?php echo $username; ?></span> </p>
                                <span><img src="<?php echo $pp; ?>" class="profile-img"></span>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="profileImage">Profile Image:</label>
                                        <input type="file" class="form-control-file" id="profileImage" name="profileImage">
                                    </div>
                                    <div class="form-group">
                                        <label for="firstName">First Name:</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName">Last Name:</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="middleInitial">Middle Initial:</label>
                                        <input type="text" class="form-control" id="middleInitial" name="middleInitial" value="<?php echo $middleInitial; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age:</label>
                                        <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNum">Phone Number:</label>
                                        <input type="text" class="form-control" id="phoneNum" name="phoneNum" minlength="1" maxlength="11" value="<?php echo $phoneNum; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Save Profile">
                                    </div>
                                    <div class="form-group">
                                        <a href="user_profile.php" class="btn btn-primary">Back</a>
                                    </div>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
