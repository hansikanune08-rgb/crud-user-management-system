<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "admin") {
    die("Access Denied! Only admins can access this page.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Welcome Admin</h2>

<p>You have successfully logged in as an Administrator.</p>

<a href="manage_users.php">
    <button>Manage Users</button>
</a>

</div>

</body>
</html>