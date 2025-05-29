<?php
session_start();
include("db_connect.php"); // Ensure $RMAQconn is your connection variable here

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and fetch inputs (adjust as necessary for your form names)
    $voter_id = htmlspecialchars($_POST['RMAQvoter_id'] ?? '');
    $voter_name = htmlspecialchars($_POST['RMAQvoter_name'] ?? '');
    $date_of_birth = htmlspecialchars($_POST['RMAQdob'] ?? '');
    $gender = htmlspecialchars($_POST['RMAQgender'] ?? '');
    $contact_information = htmlspecialchars($_POST['RMAQcontact'] ?? '');
    $voter_accesscode = htmlspecialchars($_POST['RMAQpassword'] ?? '');

    if (empty($voter_id) || empty($voter_accesscode)) {
        echo "Please fill in the required fields.";
        exit;
    }

    if (!$RMAQconn) {
        die("Database connection failed.");
    }

    // Prepare insert statement
    $sql = "INSERT INTO voter_table (voter_id, voter_name, date_of_birth, gender, contact_information, voter_accesscode) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $RMAQconn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $RMAQconn->error);
    }

    // Bind parameters: assuming voter_id is INT, contact_information is BIGINT, others VARCHAR
    $stmt->bind_param("isssis", $voter_id, $voter_name, $date_of_birth, $gender, $contact_information, $voter_accesscode);

    if ($stmt->execute()) {
        echo "Registration successful.";
        // Optionally redirect or continue logic here
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $RMAQconn->close();

} else {
    echo "Invalid request method.";
}
?>