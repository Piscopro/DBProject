<?php
    include "db_connect.php";

    // Kiểm tra xem người dùng đang cố gắng đăng ký hay đăng nhập
    if (isset($_POST['registerFirstName'])) {
        // Đăng ký

        // Nhận dữ liệu từ form
        $firstName = $_POST['registerFirstName'];
        $lastName = $_POST['registerLastName'];
        $email = $_POST['registerEmail'];
        $password = $_POST['registerPassword'];

        $sql = "INSERT INTO users (userFirstName, userLastName, userEmail, userPassword)
        VALUES ('$firstName', '$lastName', '$email', '$password')";

        if ($mysqli->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else if (isset($_POST['loginEmail'])) {
        // Đăng nhập

        // Nhận dữ liệu từ form
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        // Tìm người dùng trong cơ sở dữ liệu
        $sql = "SELECT * FROM users WHERE userEmail = '$email'";
        $result = $mysqli->query($sql);

        // Bắt đầu phiên
        session_start();

        if ($result->num_rows > 0) {
            // Người dùng tồn tại, kiểm tra mật khẩu

            $user = $result->fetch_assoc();
            if ($password == $user['userPassword']) {
                // Đăng nhập thành công, lưu id người dùng vào phiên
                $_SESSION['userId'] = $user['userID'];
                // Chuyển hướng người dùng tới profile.php
                header("Location: homepage.php");
                exit;
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "User not found";
        }
        
    }

    $mysqli->close();
?>