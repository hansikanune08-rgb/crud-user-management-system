<?php
include "db.php";

if(isset($_POST['submit'])){

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];


$query = "INSERT INTO users
(name,email,phone,password)
VALUES
('$name','$email','$phone','$password')";


if(mysqli_query($conn,$query)){
    echo "User Registered Successfully";
}

}

?>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>User Registration</h2>

<form action="register.php" method="POST" onsubmit="return validateForm();">

<label for="name">Name:</label><br>
<input type="text" id="name" name="name" placeholder="Enter your name"><br><br>

<label for="email">Email:</label><br>
<input type="email" id="email" name="email" placeholder="Enter your email"><br><br>

<label for="phone">Phone:</label><br>
<input type="text" id="phone" name="phone" placeholder="Enter 10-digit phone number"><br><br>

<label for="password">Password:</label><br>
<input type="password" id="password" name="password" placeholder="Enter your password"><br><br>

<input type="submit" name="submit" value="Register">

</form>
</div>

</body>
<script src="script.js"></script>
</html>