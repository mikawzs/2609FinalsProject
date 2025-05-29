<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3 class="text-center">Enter OTP Sent to Your Email</h3>
    <form action="verify_process.php" method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label>OTP</label>
            <input type="text" name="RMAQotp_input" class="form-control" required>
        </div>
        <button class="btn btn-primary w-100">Verify OTP</button>
    </form>
</div>
</body>
</html>