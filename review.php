<?php
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  // Khởi động phiên làm việc
  // session_start();

  // Kiểm tra xem form có được gửi không
  if ($_SERVER['REQUEST_METHOD'] == "POST") {

      
      /// Insert data into the places table using prepared statements
      $stmtInsertReview = $mysqli->prepare("INSERT INTO reviews (content, rating, placeID, userID, date) VALUES (?, ?, ?, ?, ?)");

      // Bind parameters
      $stmtInsertReview->bind_param("siiis", $content, $rating, $placeId, $userId, $postDate);

      // Set parameters
      $content = $_POST['content'];
      $rating = $_POST['rating'];
      $userId = $_SESSION['userId'];
      $postDate = date("Y-m-d");
      $placeId = $id;
    
      if ($stmtInsertReview->execute()) {
          // Close the statement
          $stmtInsertReview->close();
      } else {
          echo "Error inserting data into reviews table: " . $sqlInsertReview . "<br>" . $mysqli->error;
      }
  }

  // Đóng kết nối cơ sở dữ liệu
  $mysqli->close();
?>

<div class="row mt-4">
    <div class="col">
      <h2>Review and Ratings</h2>
      
      <!-- Comment Form -->
      <form action="add_review.php" method="post">
        <div class="mb-3">
          <label for="content" class="form-label">Your review:</label>
          <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ratings:</label>
            <div>
                <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
            </div>
        </div>

        <input type="hidden" name="placeid" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Post review</button>
      </form>
  
      <?php include "show_review.php" ?>
  </div>