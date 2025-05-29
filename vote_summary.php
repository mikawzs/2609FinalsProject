<?php
session_start();
include("db_connect.php");

if ($_SESSION['RMAQrole'] == 'Voter') {
    header("Location: index.php");
    exit;
}

$RMAQsql = "SELECT c.candidate_name, c.election_position, v.vote_count
            FROM votecount_table v
            JOIN candidate_table c ON v.candidate_id = c.candidate_id
            ORDER BY c.election_position";
$RMAQres = $RMAQconn->query($RMAQsql);
?>

<!DOCTYPE html>
<html>
<head><title>Vote Summary</title></head>
<body>
<h2>Vote Summary</h2>
<table border="1">
    <tr><th>Candidate</th><th>Position</th><th>Votes</th></tr>
    <?php while ($RMAQrow = $RMAQres->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($RMAQrow['candidate_name']) ?></td>
            <td><?= htmlspecialchars($RMAQrow['election_position']) ?></td>
            <td><?= $RMAQrow['vote_count'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</body>
</html>