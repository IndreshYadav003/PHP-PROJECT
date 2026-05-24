<?php

$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'partials/dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password == $cpassword) {

        $sql = "INSERT INTO users (username, password, dt)
                VALUES ('$username', '$password', current_timestamp())";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
        }

    } else {
        $showError = "Passwords do not match";
    }
}
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<title>Signup</title>

</head>

<body>

<?php require 'partials/_nav.php'; ?>

<div class="container mt-4">

<h1 class="text-center">Signup to our website</h1>

<?php
if ($showAlert) {
    echo '<div class="alert alert-success">
            Account created successfully
          </div>';
}

if ($showError) {
    echo '<div class="alert alert-danger">
            '.$showError.'
          </div>';
}
?>

<form action="signup.php" method="POST">

  <div class="mb-3">
    <label class="form-label">Username</label>

    <input type="text"
           class="form-control"
           name="username"
           required>
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>

    <input type="password"
           class="form-control"
           name="password"
           required>
  </div>

  <div class="mb-3">
    <label class="form-label">Confirm Password</label>

    <input type="password"
           class="form-control"
           name="cpassword"
           required>
  </div>

  <button type="submit" class="btn btn-primary">
    Signup
  </button>

</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>