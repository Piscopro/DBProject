<?php
    include 'db_connect.php';
    session_start();

    $userId = $_SESSION['userId'];

    $sql = "SELECT userFirstName, userLastName FROM users WHERE userID = $userId ";
    $result = $mysqli->query($sql);

    // Lấy dữ liệu từ kết quả truy vấn
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['userFirstName'];
        $lastName = $row['userLastName'];
    } else {
        echo "No results found";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pistravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <?php 
        echo "<h1>Hello, " . $firstName . " " . $lastName . "!</h1>"; 
        ?>
    </body>
    
</html>