<?php
session_start();
include("db_connect.php");

// Restrict access
if (!isset($_SESSION['RMAQuser_id']) || $_SESSION['RMAQrole'] == 'Voter') {
    header("Location: index.php");
    exit;
}

$RMAQrole = $_SESSION['RMAQrole'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?= htmlspecialchars($RMAQrole) ?>!</h2>
    <ul class="list-group mt-4">
        <?php if ($RMAQrole == 'Admin'): ?>
            <li class="list-group-item"><a href="view_users.php">Manage Users</a></li>
            <li class="list-group-item"><a href="view_logs.php">View Logs</a></li>
        <?php endif; ?>
        <?php if ($RMAQrole == 'Organizer' || $RMAQrole == 'Admin'): ?>
            <li class="list-group-item"><a href="view_candidates.php">Manage Candidates</a></li>
            <li class="list-group-item"><a href="vote_summary.php">Vote Summary</a></li>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>