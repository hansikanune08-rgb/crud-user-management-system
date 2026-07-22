<?php
include 'db.php';

// Check if ID exists
if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = $_GET['id'];

// Fetch user details
$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$user = mysqli_fetch_assoc($result);

// If user not found
if (!$user) {
    echo "User not found!";
    exit();
}

// Update user
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    mysqli_query($conn, "UPDATE users SET
        name='$name',
        email='$email',
        phone='$phone'
        WHERE id='$id'");

    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>Edit User</h2>

    <form method="POST">

        <label>Name:</label>

        <input
            type="text"
            name="name"
            value="<?php echo $user['name']; ?>"
            required>

        <label>Email:</label>

        <input
            type="email"
            name="email"
            value="<?php echo $user['email']; ?>"
            required>

        <label>Phone:</label>

        <input
            type="text"
            name="phone"
            value="<?php echo $user['phone']; ?>"
            required>

        <input
            type="submit"
            name="update"
            value="Update">

    </form>

</div>

</body>
</html>