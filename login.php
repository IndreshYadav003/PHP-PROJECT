<?php

$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'partials/dbconnect.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users
            WHERE username='$username'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    // CHECK QUERY ERROR
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }

    $num = mysqli_num_rows($result);

    if ($num == 1) {

        session_start();

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("location: welcome.php");

    } else {

        $showError = "Invalid Credentials";

    }
}
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<title>Login</title>

</head>

<body>

<?php require 'partials/_nav.php'; ?>

<div class="container mt-4">

<h1 class="text-center">Login to our website</h1>

<?php
if ($showError) {
    echo '<div class="alert alert-danger">'.$showError.'</div>';
}
?>

<form action="login.php" method="POST">

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

  <button type="submit" class="btn btn-primary">
    Login
  </button>

</form>

</div>

</body>
</html>