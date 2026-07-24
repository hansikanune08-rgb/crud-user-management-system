<?php
include "db.php";
$message = "";
$messageColor = "red";

if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Empty field validation
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($role)) {
        $message = "All fields are required.";
    }

    // Email validation
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    }

    // Phone validation
    elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $message = "Phone number must contain exactly 10 digits.";
    }

    // Password validation
    elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters long.";
    }

    else {

        // Check duplicate email
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $message = "Email already exists.";

        } else {

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepared statement
            $stmt = $conn->prepare("INSERT INTO users(name,email,phone,password,role) VALUES(?,?,?,?,?)");

            if ($stmt) {

                $stmt->bind_param("sssss", $name, $email, $phone, $hashedPassword, $role);

                if ($stmt->execute()) {

                    $messageColor = "green";
                    $message = "User Registered Successfully.";

                } else {

                    $message = "Database Error: " . $stmt->error;

                }

                $stmt->close();

            } else {

                $message = "Database connection error.";

            }

        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>User Registration</h2>

<?php
if ($message != "") {
    echo "<p style='color:$messageColor; text-align:center; font-weight:bold;'>$message</p>";
}
?>

<form action="register.php" method="POST" onsubmit="return validateForm();">

<label>Name:</label>
<input type="text" id="name" name="name" placeholder="Enter your name">

<label>Email:</label>
<input type="email" id="email" name="email" placeholder="Enter your email">

<label>Phone:</label>
<input type="text" id="phone" name="phone" placeholder="Enter 10-digit phone number">

<label>Password:</label>
<input type="password" id="password" name="password" placeholder="Enter your password">

<label>Role:</label>
<select id="role" name="role">
    <option value="">-- Select Role --</option>
    <option value="user">User</option>
    <option value="admin">Admin</option>
</select>

<br><br>

<input type="submit" name="submit" value="Register">

</form>

</div>

<script src="script.js"></script>

</body>
</html>