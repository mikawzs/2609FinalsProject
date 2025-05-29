<?php
session_start();
include("db_connect.php");

if ($_SESSION['RMAQrole'] !== 'Admin') {
    header("Location: index.php");
    exit;
}

$RMAQsql = "SELECT l.action, l.DateTime, u.full_name 
            FROM logs_table l 
            JOIN user_table u ON l.user_id = u.user_id 
            ORDER BY l.DateTime DESC";
$RMAQres = $RMAQconn->query($RMAQsql);
?>

<!DOCTYPE html>
<html>
<head><title>System Logs</title></head>
<body>
<h2>System Logs</h2>
<table border="1">
    <tr><th>User</th><th>Action</th><th>Date/Time</th></tr>
    <?php while ($RMAQlog = $RMAQres->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($RMAQlog['full_name']) ?></td>
            <td><?= htmlspecialchars($RMAQlog['action']) ?></td>
            <td><?= $RMAQlog['DateTime'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>