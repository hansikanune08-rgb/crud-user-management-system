<?php
session_start();
include "db.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $profilePic = "";

    // Upload Profile Picture
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['name'] != "") {

        $profilePic = time() . "_" . $_FILES['profile_pic']['name'];
        $target = "uploads/" . $profilePic;

        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);

        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, profile_pic=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $email, $phone, $profilePic, $id);

    } else {

        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $phone, $id);

    }

    if ($stmt->execute()) {
        echo "<script>alert('Profile Updated Successfully');</script>";
    } else {
        echo "<script>alert('Update Failed');</script>";
    }

    $stmt->close();
}

$result = $conn->query("SELECT * FROM users WHERE id='$id'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>My Profile</h2>

<?php
if (!empty($user['profile_pic'])) {
    echo "<img src='uploads/".$user['profile_pic']."' width='120' height='120' style='border-radius:50%;'><br><br>";
}
?>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" value="<?php echo $user['name']; ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?php echo $user['email']; ?>" required>

<label>Phone</label>
<input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>

<label>Profile Picture</label>
<input type="file" name="profile_pic" accept="image/*">

<br><br>

<input type="submit" name="update" value="Update Profile">

</form>

</div>

</body>
</html>