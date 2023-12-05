<?php
    include "db_connect.php";

    $query = "SELECT content, rating, date, u.userEmail FROM reviews r
    JOIN users u ON r.userID = u.userID 
    WHERE r.placeID = $id";
    $result = $mysqli->query($query);

    if ($result === false) {
        echo "SQL Error: " . $mysqli->error; // In ra lỗi SQL nếu có
    } else {
        // Process the data
        if ($result->num_rows > 0) {
            $numReview = 0;
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
                $numReview++;
            }

            $contents = array();
            $ratings = array();
            $dates = array();
            $userEmails = array();
            for ($i = 0; $i < $numReview; $i++) {
                $contents[$i] = $rows[$i]['content'];
                $ratings[$i] = $rows[$i]['rating'];
                $dates[$i] = $rows[$i]['date'];
                $userEmails[$i] = $rows[$i]['userEmail'];
            }
        } else {
            echo "This place hasn't had any reviews yet";
        }
    } 

?>
<div class="mt-4">
    <?php
        if($result->num_rows > 0) {
            for ($i = 0; $i < $numReview; $i++) {
                echo "<div class='card mb-3'>
                    <div class='card-body'>
                        <h5 class='card-title'>$userEmails[$i]</h5>
                        <p class='card-text'>Rating: $ratings[$i]</p>
                        <p class='card-text'>$contents[$i]</p>
                    </div>
                </div>";
            }
        }
    ?>

    <!-- <div class='card mb-3'>
        <div class='card-body'>
            <h5 class='card-title'>$userEmails[$i]</h5>
            <p class='card-text'>Đánh giá: 4/5</p>
            <p class='card-text'>$contents[$i]</p>
        </div>
    </div>
        Single Comment
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Người dùng 1</h5>
            <p class="card-text">Đánh giá: 4/5</p>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div> -->
        <!-- Thêm các bình luận khác tại đây -->
</div>