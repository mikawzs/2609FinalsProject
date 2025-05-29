<?php
session_start();
include("db_connect.php");

if ($_SESSION['RMAQrole'] == 'Voter') {
    header("Location: index.php");
    exit;
}

$RMAQsql = "SELECT * FROM candidate_table ORDER BY candidate_id DESC";
$RMAQres = $RMAQconn->query($RMAQsql);
?>

<!DOCTYPE html>
<html>
<head><title>Manage Candidates</title></head>
<body>
<h2>Candidates</h2>
<table border="1">
    <tr><th>ID</th><th>Name</th><th>Party</th><th>Position</th></tr>
    <?php while ($RMAQc = $RMAQres->fetch_assoc()): ?>
        <tr>
            <td><?= $RMAQc['candidate_id'] ?></td>
            <td><?= htmlspecialchars($RMAQc['candidate_name']) ?></td>
            <td><?= htmlspecialchars($RMAQc['party_affiliation']) ?></td>
            <td><?= htmlspecialchars($RMAQc['election_position']) ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>