<?php
session_start();
include "db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] == "admin") {
                header("Location: admin.php");
            } else {
                header("Location: manage_users.php");
            }
            exit();

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "Email not found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>User Login</h2>

<?php
if ($message != "") {
    echo "<p style='color:red; text-align:center;'>$message</p>";
}
?>

<form method="POST">

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <br><br>

    <input type="submit" name="login" value="Login">

</form>

</div>

</body>
</html>