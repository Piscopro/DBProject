<?php
    include "db_connect.php";
    session_start();

    if (isset($_GET['search'])) {
        $keyword = $_GET['search'];
        $query = "SELECT placeID, placeName, placeLocation, placeDescription, placeType FROM places WHERE placeName LIKE '%$keyword%'";
        $result = $mysqli->query($query);
        if ($result === false) {
            echo "SQL Error: " . $mysqli->error; // In ra lỗi SQL nếu có
        } else {
            // Process the data
            if ($result->num_rows > 0) {
                $numres = 0;
                $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
                    $numres++;
                }

                $placeNames = array();
                $locations = array();
                $descriptions = array();
                $types = array();
                $ids = array();
                $firstImages = array();
                $firstImageUrls = array();
                for ($i = 0; $i < $numres; $i++) {
                    $placeNames[$i] = $rows[$i]['placeName'];
                    $locations[$i] = $rows[$i]['placeLocation'];
                    $descriptions[$i] = $rows[$i]['placeDescription'];
                    $types[$i] = $rows[$i]['placeType'];
                    $ids[$i] = $rows[$i]['placeID'];

                    $imgquery = "SELECT imageLabel FROM images WHERE placeID = '$ids[$i]' LIMIT 1";
                    $imgres = $mysqli->query($imgquery);
                    $imgrow = $imgres->fetch_assoc();
                    $firstImages[$i] = $imgrow['imageLabel'];
                    $firstImageUrls[$i] = "images/" . $firstImages[$i];
                }
            } else {
                echo "No results found in search";
            }
        } 

    } else {
        echo "Not";
    }

    $mysqli->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        /* Custom CSS to limit the card size */
        .custom-card {
            max-width: 600px; /* Adjust the value based on your preference */
            max-height: 200px; /* Adjust the value based on your preference */
            overflow: hidden; /* Hide overflow content if it exceeds max height */
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-3">
        <h2 class="mb-3">Search Result</h2>
        <h4 class="mb-3"> <?php echo " $numres" . " result with keyword '" . $keyword . "'"; ?> </h4>
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <?php
                for ($i = 0; $i < $numres; $i++) {
                    echo "<div class='card mb-3' style='width: 25rem;'>
                    <img src='$firstImageUrls[$i]' class='card-img-top'>
                        <div class='card-body'>
                            <a href='place.php?id=$ids[$i]'>
                                <h5 class='card-title'>$placeNames[$i]</h5>
                            </a>
                            <p class='card-text'> $locations[$i] </p>
                            <p class='card-text'>$types[$i]</p>
                        </div>
                    </div>";
                }

                ?>
                
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
