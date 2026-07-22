<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <h2>Manage Users</h2>

    <table>

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

                <a class="edit-btn" href="edit_user.php?id=<?php echo $row['id']; ?>">
                    Edit
                </a>

                <a class="delete-btn" href="delete_user.php?id=<?php echo $row['id']; ?>">
                    Delete
                </a>

            </td>

        </tr>

        <?php
        }
        ?>

    </table>

</div>

</body>

</html>