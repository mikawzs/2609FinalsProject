<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['RMAQuser_id'])) {
    header("Location: index.php");
    exit;
}

$RMAQvoter_id = $_SESSION['RMAQuser_id'];

// Check if voter has already voted
$RMAQcheck = $RMAQconn->prepare("SELECT * FROM vote_table WHERE voter_id = ?");
$RMAQcheck->bind_param("i", $RMAQvoter_id);
$RMAQcheck->execute();
$RMAQres = $RMAQcheck->get_result();

if ($RMAQres->num_rows > 0) {
    echo "<script>alert('You have already voted.'); window.location='thankyou.php';</script>";
    exit;
}

// Get positions
$RMAQsql = "SELECT * FROM position_table";
$RMAQpositions = $RMAQconn->query($RMAQsql);

// Loop through positions and insert votes
while ($RMAQpos = $RMAQpositions->fetch_assoc()) {
    $RMAQposition_name = $RMAQpos['position_name'];
    
    if (isset($_POST[$RMAQposition_name])) {
        $RMAQcandidate_id = $_POST[$RMAQposition_name];
        $RMAQstmt = $RMAQconn->prepare("INSERT INTO vote_table (voter_id, candidate_id, vote_timestamp) VALUES (?, ?, NOW())");
        $RMAQstmt->bind_param("ii", $RMAQvoter_id, $RMAQcandidate_id);
        $RMAQstmt->execute();

        // Update vote count
        $RMAQupdate = $RMAQconn->prepare("UPDATE votecount_table SET vote_count = vote_count + 1 WHERE candidate_id = ?");
        $RMAQupdate->bind_param("i", $RMAQcandidate_id);
        $RMAQupdate->execute();
    }
}

// Generate random reference code
$RMAQref = time() . strtoupper(substr(md5(rand()), 0, 5));
$_SESSION['RMAQreference_code'] = $RMAQref;

header("Location: thankyou.php");
exit;
?>