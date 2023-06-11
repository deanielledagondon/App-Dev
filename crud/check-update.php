<?php

if (isset($_GET['id'])) {
    include "config.php";

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_GET['id']);
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: admin_users.php");
    }
} elseif (isset($_POST['update'])) {
    include "config.php";

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
        header("Location: ../check-update.php?id=$id&error=All fields are required");
    } else {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES['pp']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (!empty($_FILES['pp']["tmp_name"])) {
            $extensions = array("jpeg", "jpg", "png");
            if (!in_array($imageFileType, $extensions)) {
                header("Location: ../check-update.php?id=$id&error=Invalid image format. Please choose a JPEG or PNG file.");
                exit();
            }
            if (move_uploaded_file($_FILES['pp']["tmp_name"], $targetFile)) {
                $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName', middleInitial='$middleInitial', username='$username', email='$email', password='$password', age='$age', address='$address', pp='$targetFile' WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    header("Location: ../admin_users.php?success=Successfully Updated");
                } else {
                    header("Location: ../check-update.php?id=$id&error=Unknown Error");
                }
            } else {
                header("Location: ../check-update.php?id=$id&error=Error uploading the image. Please try again.");
            }
        } else {
            $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName', middleInitial='$middleInitial', username='$username', email='$email', password='$password', age='$age', address='$address' WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../admin_users.php?success=Successfully Updated");
            } else {
                header("Location: ../check-update.php?id=$id&error=Unknown Error");
            }
        }
    }
} else {
    header("Location: check-update.php");
}
?>
