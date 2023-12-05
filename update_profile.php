<?php
    include 'db_connect.php';
    session_start();

    // Nhận dữ liệu từ form
    $userId = $_SESSION['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $birthdate = $_POST['birthdate'];

    // Cập nhật cơ sở dữ liệu
    $sql = "UPDATE users SET userFirstName = '$firstName', userLastName = '$lastName', userEmail = '$email', userPassword = '$password', userCity = '$city', userBirthDate = '$birthdate' WHERE userID = $userId";
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }

    $mysqli->close();
?>
