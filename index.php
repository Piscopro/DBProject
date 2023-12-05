<html>
  <head>
    <title>Pistravel</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mx-auto mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Pistravel</h2>
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" href="#pills-login" role="tab">Login</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-register-tab" data-bs-toggle="pill" href="#pills-register" role="tab">Register</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel">
                                <form action="login.php" method="post">
                                    <div class="mb-3">
                                        <label for="loginEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="loginEmail" name="loginEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label for="loginPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-register" role="tabpanel">
                                <form action="login.php" method="post">
                                    <div class="mb-3">
                                        <label for="registerFirstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="registerFirstName" name="registerFirstName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registerLastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="registerLastName" name="registerLastName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registerEmail" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="registerEmail" name="registerEmail">
                                    </div>
                                    <div class="mb-3">
                                        <label for="registerPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="registerPassword" name="registerPassword">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </form>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            var password = document.getElementById('registerPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            if (password !== confirmPassword) {
                alert('Password and Confirm Password do not match!');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>