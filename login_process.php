<?php
session_start();
include("db_connect.php"); // defines $RMAQ_conn

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $RMAQStudentNumber = htmlspecialchars($_POST['RMAQstudent_number'] ?? '');
    $RMAQPassword = htmlspecialchars($_POST['RMAQpassword'] ?? '');

    if (empty($RMAQStudentNumber) || empty($RMAQPassword)) {
        echo "Please enter both Student Number and Password.";
        exit;
    }

    if (!$RMAQ_conn) {
        die("Database connection failed.");
    }

    $RMAQsql = "SELECT * FROM voter_table WHERE voter_id = ? AND voter_accesscode = ?";
    $RMAQstmt = $RMAQ_conn->prepare($RMAQsql);

    if ($RMAQstmt) {
        $RMAQstmt->bind_param("ss", $RMAQStudentNumber, $RMAQPassword);
        $RMAQstmt->execute();
        $RMAQresult = $RMAQstmt->get_result();

        if ($RMAQresult->num_rows === 1) {
            $RMAQuser = $RMAQresult->fetch_assoc();
            $_SESSION['RMAQuser_id'] = $RMAQuser['voter_id'];
            $_SESSION['RMAQlogged_in'] = true;
            header("Location: vote.php");
            exit;
        } else {
            echo "❌ No voter found with that Student Number or Password.";
        }

        $RMAQstmt->close();
    } else {
        echo "Error preparing query.";
    }
} else {
    echo "Invalid request method.";
}
?>