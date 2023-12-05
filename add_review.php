<?php
    include "db_connect.php";
  // Khởi động phiên làm việc
  session_start();

    /// Insert data into the places table using prepared statements
    $stmtInsertReview = $mysqli->prepare("INSERT INTO reviews (content, rating, placeID, userID) VALUES (?, ?, ?, ?)");

    // Bind parameters
    $stmtInsertReview->bind_param("siii", $content, $rating, $placeId, $userId);

    // Set parameters
    $content = $_POST['content'];
    $rating = $_POST['rating'];
    $userId = $_SESSION['userId'];
    $placeId = $_POST['placeid'];

    if ($stmtInsertReview->execute()) {
        echo "Review added successfully";
    } else {
        echo "Error inserting data into reviews table: " . $sqlInsertReview . "<br>" . $mysqli->error;
    }
    
    $stmtInsertReview->close();
  // Đóng kết nối cơ sở dữ liệu
  $mysqli->close();
?>