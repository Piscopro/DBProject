<?php
    include 'db_connect.php';
    session_start();

    $userId = $_SESSION['userId'];

    $sql = "SELECT userFirstName, userLastName, userEmail, userPassword, userCity, userBirthDate FROM users WHERE userID = $userId ";
    $result = $mysqli->query($sql);

    // Lấy dữ liệu từ kết quả truy vấn
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['userFirstName'];
        $lastName = $row['userLastName'];
        $email = $row['userEmail'];
        $password = $row['userPassword'];
        $city = $row['userCity'];
        $birthdate = $row['userBirthDate'];
    } else {
        echo "No results found";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
    <!-- User Info Card -->
    <div class="card">
        <div class="card-header">
            User Information
        </div>
        <div class="card-body">
            <form id="userInfoForm" action="update_profile.php" method="post">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $city ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Birthdate:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $birthdate ?>" disabled>
                </div>
                <button type="button" class="btn btn-primary" id="editButton" onclick="enableEdit()">Edit Information</button>
                <button type="button" class="btn btn-success d-none" id="saveButton" onclick="saveInformation()">Save</button>
            </form>
        </div>
    </div>

    <!-- User Contributions -->
    <div class="mt-5">
        <h2>User Contributions</h2>
        <!-- Places -->
        <div class="mb-3">
            <h4>Places:</h4>
            <ul class="list-group">
                <li class="list-group-item">Place 1</li>
                <li class="list-group-item">Place 2</li>
                <!-- Add more places as needed -->
            </ul>
        </div>

        <!-- Comments -->
        <div class="mb-3">
            <h4>Comments:</h4>
            <ul class="list-group">
                <li class="list-group-item">Comment 1</li>
                <li class="list-group-item">Comment 2</li>
                <!-- Add more comments as needed -->
            </ul>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function enableEdit() {
        // Enable input fields
        document.getElementById('firstName').disabled = false;
        document.getElementById('lastName').disabled = false;
        document.getElementById('email').disabled = false;
        document.getElementById('password').disabled = false;
        document.getElementById('city').disabled = false;
        document.getElementById('birthdate').disabled = false;

        // Show Save button and hide Edit button
        document.getElementById('editButton').classList.add('d-none');
        document.getElementById('saveButton').classList.remove('d-none');
    }

    function saveInformation() {
        // Send form
        document.getElementById('userInfoForm').submit();

        // Disable input fields
        document.getElementById('firstName').disabled = true;
        document.getElementById('lastName').disabled = true;
        document.getElementById('email').disabled = true;
        document.getElementById('password').disabled = true;
        document.getElementById('city').disabled = true;
        document.getElementById('birthdate').disabled = true;

        // Show Edit button and hide Save button
        document.getElementById('editButton').classList.remove('d-none');
        document.getElementById('saveButton').classList.add('d-none');
    }
</script>

</body>
</html>
<?php
    $mysqli->close();
?>