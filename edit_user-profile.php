<?php
include "config.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: admin_login.php");
}

if (isset($_GET['id'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_GET['id']);
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $middleInitial = $row['middleInitial'];
        $username = $row['username'];
        $email = $row['email'];
        $password = $row['password'];
        $age = $row['age'];
        $address = $row['address'];
        $phoneNum = $row['phoneNum'];
        $pp = $row['pp'];
    } else {
        header("Location: admin_users.php");
    }
} elseif (isset($_POST['update_profile'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_POST['id']);
    $firstName = validate($_POST['firstName']);
    $lastName = validate($_POST['lastName']);
    $middleInitial = validate($_POST['middleInitial']);
    $username = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $age = validate($_POST['age']);
    $address = validate($_POST['address']);

    if (empty($firstName) || empty($lastName) || empty($middleInitial) || empty($username) || empty($email) || empty($password) || empty($age) || empty($address)) {
        header("Location: ../edit_user-profile.php?id=$id&error=All fields are required");
        exit();
    } else {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES['pp']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (!empty($_FILES['pp']["tmp_name"])) {
            $extensions = array("jpeg", "jpg", "png");
            if (!in_array($imageFileType, $extensions)) {
                header("Location: ../edit_user-profile.php?id=$id&error=Invalid image format. Please choose a JPEG or PNG file.");
                exit();
            }
            if (move_uploaded_file($_FILES['pp']["tmp_name"], $targetFile)) {
                $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName', middleInitial='$middleInitial', username='$username', email='$email', password='$password', age='$age', address='$address', pp='$targetFile' WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("Location: ../admin_users.php?success=Successfully Updated");
                } else {
                    header("Location: ../edit_user-profile.php?id=$id&error=Unknown Error");
                }
            } else {
                header("Location: ../edit_user-profile.php?id=$id&error=Error uploading the image. Please try again.");
            }
        } else {
            $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName', middleInitial='$middleInitial', username='$username', email='$email', password='$password', age='$age', address='$address' WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../admin_users.php?success=Successfully Updated");
            } else {
                header("Location: ../edit_user-profile.php?id=$id&error=Unknown Error");
            }
        }
    }
} else {
    header("Location: admin_login.php");
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
            <form method="post" enctype='multipart/form-data' action="">
                <div class="login_form">
                    <div class="row">
                        <div class="col">
                            <?php
                            if (!empty($pp)) {
                                echo '<img src="uploads/' . $pp . '" style="height:80px;width:auto;border-radius:50%;">';
                            }
                            ?>
                            <div class="form-group">
                                <label>Change Image &#8595;</label>
                                <input class="form-control" type="file" name="pp" style="width:100%;">
                            </div>
                        </div>
                        <div class="col">
                            <p><a href="logout.php"><span style="color:red;">Logout</span></a></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label>First Name</label>
                            </div>
                            <div class="col">
                                <input type="text" name="firstName" value="<?php echo $firstName; ?>"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label>Last Name</label>
                            </div>
                            <div class="col">
                                <input type="text" name="lastName" value="<?php echo $lastName; ?>"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label>Username</label>
                            </div>
                            <div class="col">
                                <input type="text" name="username" value="<?php echo $username; ?>"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-success" name="update_profile">Save Profile</button>
                        </div>
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
