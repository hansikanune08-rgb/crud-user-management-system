<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM users");

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>

<body>
    <title>Manage Users</title>
</head>

<body>

<h2>Manage Users</h2>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>

    <td>
        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
        |
        <a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
    </td>

</tr>

<?php
}
?>

</table>

</body>
</html>