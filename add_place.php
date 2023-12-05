<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // Khởi động phiên làm việc
    session_start();

    // Kết nối với cơ sở dữ liệu
    include 'db_connect.php';

    // Kiểm tra xem form có được gửi không
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // Lấy dữ liệu từ form
        $placeName = $_POST['placeName'];
        $placeLocation = $_POST['placeLocation']; // Corrected variable name
        $placeDescription = $_POST['placeDescription'];
        $placeType = $_POST['placeType'];

        // File upload handling
        if (isset($_FILES["placeImages"])) {
            $targetDirectory = "images/";

            // Capture the current date and time
            $uploadDate = date("Y-m-d");

            /// Insert data into the places table using prepared statements
            $stmtInsertPlace = $mysqli->prepare("INSERT INTO places (placeName, placeLocation, placeDescription, placeType, userID) VALUES (?, ?, ?, ?, ?)");

            // Bind parameters
            $stmtInsertPlace->bind_param("ssssi", $placeName, $placeLocation, $placeDescription, $placeType, $userId);

            // Set parameters
            $placeName = $_POST['placeName'];
            $placeLocation = $_POST['placeLocation'];
            $placeDescription = $_POST['placeDescription'];
            $placeType = $_POST['placeType'];
            $userId = $_SESSION['userId'];

            if ($stmtInsertPlace->execute()) {
                // Retrieve the generated placeId
                $placeId = $mysqli->insert_id;

                // Loop through each uploaded file
                for ($i = 0; $i < count($_FILES["placeImages"]["name"]); $i++) {
                    $targetFile = $targetDirectory . basename($_FILES["placeImages"]["name"][$i]);

                    if (move_uploaded_file($_FILES["placeImages"]["tmp_name"][$i], $targetFile)) {
                        // Insert data into the images table with the obtained placeId
                        $imageLabel = basename($targetFile);
                        $sqlInsertImage = "INSERT INTO images (placeID, imageLabel, uploadDate, userID) VALUES ('$placeId', '$imageLabel', '$uploadDate', '$userId')";

                        if ($mysqli->query($sqlInsertImage) !== TRUE) {
                            echo "Error inserting data into images table: " . $sqlInsertImage . "<br>" . $mysqli->error;
                        }
                    } else {
                        echo "Sorry, there was an error uploading one or more files.";
                    }
                }
                // Close the statement
                $stmtInsertPlace->close();
            } else {
                echo "Error inserting data into places table: " . $sqlInsertPlace . "<br>" . $mysqli->error;
            }
        }
    }

    // Đóng kết nối cơ sở dữ liệu
    $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Place</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Add New Place</h2>
        <form id="addPlaceForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="placeName" class="form-label">Place Name:</label>
                <input type="text" class="form-control" id="placeName" name="placeName" placeholder="Enter place name" required>
            </div>

            <div class="mb-3">
                <label for="placeLocation" class="form-label">Place Location:</label>
                <input type="text" class="form-control" id="placeLocation" name="placeLocation" placeholder="Enter place location" required>
            </div>

            <div class="mb-3">
                <label for="placeDescription" class="form-label">Description:</label>
                <textarea class="form-control" id="placeDescription" name="placeDescription" rows="4" placeholder="Enter place description" required></textarea>
            </div>

            <div class="mb-3">
                <label for="placeType" class="form-label">Place Type:</label>
                <select class="form-select" id="placeType" name="placeType" required>
                    <option value="Historical">Historical</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Restaurant">Restaurant</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="placeImage" class="form-label">Place Image:</label>
                <input type="file" class="form-control" id="placeImages" name="placeImages[]" accept="image/*" multiple required>
            </div>

            <button type="submit" class="btn btn-primary">Add Place</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional)
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("addPlaceForm").addEventListener("submit", function(event) {
            event.preventDefault();

            var placeName = document.getElementById("placeName").value;
            var placeLocation = document.getElementById("placeLocation").value;
            var placeDescription = document.getElementById("placeDescription").value;
            var placeType = document.getElementById("placeType").value;

            alert("New place added:\nName: " + placeName + "\nLocation: " + placeLocation + "\nDescription: " + placeDescription + "\nType: " + placeType);
        });
    </script> -->
</body>
</html>