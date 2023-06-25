<?php
include 'config.php';
session_start();

$id = $_GET['id'];

// Fetch the user's information from the database based on the user ID
$findresult = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$id'");

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

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedFirstName = $_POST['firstName'];
    $updatedLastName = $_POST['lastName'];
    $updatedMiddleInitial = $_POST['middleInitial'];
    $updatedUsername = $_POST['username'];
    $updatedEmail = $_POST['email'];
    $updatedAge = $_POST['age'];
    $updatedAddress = $_POST['address'];
    $updatedPhoneNum = $_POST['phoneNum'];

    $updatesMade = false;
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
        $updatesMade = true;
    }

    if ($updatesMade) {
        if (mysqli_query($conn, "UPDATE users SET 
            firstName='$updatedFirstName', 
            lastName='$updatedLastName', 
            middleInitial='$updatedMiddleInitial', 
            username='$updatedUsername', 
            email='$updatedEmail', 
            age='$updatedAge', 
            address='$updatedAddress', 
            phoneNum='$updatedPhoneNum' 
            WHERE email='$email'")) {
            
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

            $successMessage = "Profile updated successfully.";
        } else {
            $errorMessage = "Error: Failed to update profile.";
        }
    }

    if ($_FILES['admin_profileImage']['name'] != '') {
        $tmpFilePath = $_FILES['admin_profileImage']['tmp_name'];
        $uploadPath = 'uploads/' . $_FILES['admin_profileImage']['name'];

        if (move_uploaded_file($tmpFilePath, $uploadPath)) {
            if (mysqli_query($conn, "UPDATE users SET pp='$uploadPath' WHERE email='$email'")) {
                $pp = $uploadPath;
                $successMessage = "Profile image uploaded successfully.";
            } else {
                $errorMessage = "Error: Failed to upload the profile image.";
            }
        } else {
            $errorMessage = "Error: Failed to upload the profile image.";
        }
    }
}
?>


<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
              <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <div class="login_form">
                     <?php if ($successMessage): ?>
                                <div class="alert alert-success"><?php echo $successMessage; ?></div>
                            <?php endif; ?>

                            <?php if ($errorMessage): ?>
                                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                            <?php endif; ?>

                    <div class="row">
                        <div class="col"></div>
                        <div class="col-6">
                            <center>
                            <span>
                                <img src="<?php echo $pp; ?>" class="profile-img">
                                </span>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <div class="row"> 
                                          <div class="col">
                                        <label for="admin_profileImage">Profile Image:</label>
                                        </div>
                                           <input type="file" class="form-control" id="admin_profileImage" name="admin_profileImage">
                                        </div>
                                    </div>
                                </div>                                    
                                    <div class="form-group">
                                        <label for="firstName">First Name:</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>">
                                    </div>
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
                                        <input type="submit" class="update-btn" value="Save Profile">
                                    </div>
                                    <div class="form-group">
                                    <?php if (isset($_SESSION["admin_id"])): ?>
                                        <a href="users_table.php" class="btn">Back</a>
                                    <?php else: ?>
                                        <a href="home.php" class="btn">Back</a>
                                    <?php endif; ?>
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