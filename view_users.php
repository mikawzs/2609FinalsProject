<?php
session_start();
include("db_connect.php");

if ($_SESSION['RMAQrole'] !== 'Admin') {
    header("Location: index.php");
    exit;
}

$RMAQsql = "SELECT * FROM user_table ORDER BY user_id DESC";
$RMAQres = $RMAQconn->query($RMAQsql);
?>

<!DOCTYPE html>
<html>
<head><title>Manage Users</title></head>
<body>
<h2>Users</h2>
<table border="1">
    <tr><th>ID</th><th>Name</th><th>Username</th><th>Role</th><th>Email</th></tr>
    <?php while ($RMAQu = $RMAQres->fetch_assoc()): ?>
        <tr>
            <td><?= $RMAQu['user_id'] ?></td>
            <td><?= htmlspecialchars($RMAQu['full_name']) ?></td>
            <td><?= $RMAQu['username'] ?></td>
            <td><?= $RMAQu['role'] ?></td>
            <td><?= $RMAQu['email'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
