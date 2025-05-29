<?php
session_start();
include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $RMAQusername = htmlspecialchars($_POST['RMAQusername']);
    $RMAQpassword = htmlspecialchars($_POST['RMAQpassword']);

    $RMAQsql = "SELECT * FROM user_table WHERE username=? AND password=?";
    $RMAQstmt = $RMAQconn->prepare($RMAQsql);
    $RMAQstmt->bind_param("ss", $RMAQusername, $RMAQpassword); // TODO: Hash password
    $RMAQstmt->execute();
    $RMAQresult = $RMAQstmt->get_result();

    if ($RMAQresult->num_rows === 1) {
        $RMAQuser = $RMAQresult->fetch_assoc();
        $_SESSION['RMAQuser_id'] = $RMAQuser['user_id'];
        $_SESSION['RMAQrole'] = $RMAQuser['role'];
        header("Location: vote.php");
        exit;
    } else {
        echo "<script>alert('Invalid credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voting System - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body style="background: url('images/bg.jpg') no-repeat center center fixed; background-size: cover;">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
            <div class="card-header text-center bg-warning">
                <img src="images/banner.jpg" class="img-fluid" style="max-height: 80px;" alt="Banner">
                <h5 class="mt-2 mb-0">Electronic Voting System</h5>
            </div>
            <div class="card-body">
                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="student_number" class="form-label">Student Number</label>
                        <input type="text" name="RMAQstudent_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="RMAQpassword" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold">Login</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <small>Powered by UST SITE - Society of Information Technology Enthusiasts</small>
            </div>
        </div>
    </div>
</body>
</html>