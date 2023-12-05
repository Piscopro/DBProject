<?php
    include 'db_connect.php';
    // session_start();

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $query = "SELECT placeName, placeLocation, placeDescription, placeType, userEmail, imageLabel, AVG(r.rating) AS rating FROM places p 
                JOIN users u ON p.userID = u.userID 
                JOIN images i ON i.placeID = p.placeID
                JOIN reviews r ON r.placeID = p.placeID
                WHERE p.placeID = $id";

      $result = $mysqli->query($query);
      if ($result === false) {
          echo "SQL Error: " . $mysqli->error; // In ra lỗi SQL nếu có
      } else {
          // Process the data
          if ($result->num_rows > 0) {
              $numImage = 0;
              $rows = array();
              while ($row = $result->fetch_assoc()) {
                  $rows[] = $row;
                  $numImage++;
              }

              $placeName = $rows[0]['placeName'];
              $location = $rows[0]['placeLocation'];
              $description = $rows[0]['placeDescription'];
              $type = $rows[0]['placeType'];
              $upload_user = $rows[0]['userEmail'];
              $rating = $rows[0]['rating'];
              $roundedRating = round($rating, 1);
              
              $imageLabels = array();
              for ($i = 0; $i < $numImage; $i++) {
                $imageLabels[$i] = $rows[$i]['imageLabel'];
              }
          } else {
              echo "No results found in place";
          }
      }
    }

    
  

?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Place name</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Add your custom styles here -->
  <style>
    /* Customize styles as needed */
  </style>
</head>
<body>

<!-- Navbar -->
<?php include 'navbar.php'; ?>

<!-- Main content -->
<div class="container mt-4">
  <!-- Product details -->
  <div class="row">
    <div class="col-md-6">
      <!-- Add your product image here -->
      <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <?php
              for ($i = 0; $i < $numImage; $i++) {
                if ($i == 0) {
                  echo  "<li data-bs-target='#carouselId' data-bs-slide-to='0' class='active' aria-current='true' aria-label='First slide'></li>";
                } else {
                  echo  "<li data-bs-target='#carouselId' data-bs-slide-to=$i></li>";
                }

              }
            ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
              // Assuming basePath is the base path of your images
              $basePath = "images/";
              
              $imageUrls = array();
              for ($i = 0; $i < $numImage; $i++) {
                // Combine the base path and image label to get the complete image URL
                $imageUrls[$i] = $basePath . $imageLabels[$i];
                $i1 = $i + 1;
                if ($i == 0) {
                  echo  "<div class='carousel-item active'>
                        <img src= $imageUrls[$i] class='w-100 d-block'>
                    </div>";
                } else {
                  echo  "<div class='carousel-item'>
                        <img src= $imageUrls[$i] class='w-100 d-block'>
                    </div>";
                }
              }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
      </div>
    </div>
    <div class="col-md-6">
        <!-- Place details -->
      <!-- <h1 class="mb-3">Place name</h1> -->
      <?php 
        echo "<h1 class='mb-3'>" . $placeName . "</h1>"; 
      ?>
      <p class="lead">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
          <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
        </svg>
        <?php echo " $upload_user"; ?>
      </p>
      <p>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
          <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
        </svg>
        <?php echo " $location"; ?>
      </p>
      <?php 
        echo "<p>Average rating: $roundedRating </p>"; 
      ?>
      <?php 
        echo "<p>Type: $type </p>"; 
      ?>
    </div>
  </div>

  <!-- Additional information -->
<div class="row mt-4">
    <div class="col">
      <h2>Description</h2>
      <?php 
        echo "<p> $description </p>"; 
      ?>
    </div>
  </div>
  
  <!-- Comments and Ratings -->
  <?php include "review.php"; ?>


<!-- Footer -->
<footer class="bg-dark text-light text-center p-3 mt-5">
<footer class="n">
  <p>&copy; Pistravel 2023. All rights reserved.</p>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Assuming imageLabel is the variable containing the image label from the database
    var imageLabel = "Cultural-values-of-imperial-citadel-of-Thang-Long.jpg";

    // Assuming basePath is the base path of your images
    var basePath = "/images/";

    // Combine the base path and image label to get the complete image URL
    var imageUrl = basePath + imageLabel;

    // Get the image container element by its ID
    var imageContainer = document.getElementById('dynamicImageContainer');

    // Get the image element by its ID
    var imgElement = document.getElementById('dynamicImage');

    // Set the src attribute with the complete image URL
    imgElement.src = imageUrl;

    // You can also set the alt attribute if needed
    imgElement.alt = "Image description";
</script>

</body>
</html>