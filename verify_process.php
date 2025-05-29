<?php
session_start();
include("db_connect.php");

$RMAQentered = $_POST['RMAQotp_input'];

if ($RMAQentered == $_SESSION['RMAQotp']) {
    $u = $_SESSION['RMAQtempUser'];
    $sql = "INSERT INTO user_table (full_name, role, username, password, email)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $RMAQconn->prepare($sql);
    $stmt->bind_param("sssss", $u['RMAQname'], $u['RMAQrole'], $u['RMAQusername'], $u['RMAQpassword'], $u['RMAQemail']);
    $stmt->execute();
    
    echo "<script>alert('OTP Verified! You can now login.'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Invalid OTP'); window.location='verify_otp.php';</script>";
}
?>