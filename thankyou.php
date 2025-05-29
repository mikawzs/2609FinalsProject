<?php
session_start();
if (!isset($_SESSION['RMAQreference_code'])) {
    header("Location: index.php");
    exit;
}

// Auto redirect after 60 seconds
header("refresh:60;url=index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fffdee;
            font-family: 'Segoe UI', sans-serif;
        }
    </style>
</head>
<body class="text-center py-5">
    <img src="images/tiger.png" width="180" class="mb-4" alt="Mascot">
    <h3 class="fw-bold">Thank you for participating in the 2025 Philippine Senatorial Elections!</h3>
    <p class="mt-3">Your vote has been recorded successfully.</p>
    <p>Please take note of your <strong>Voting Reference Code</strong>:</p>
    <h4 class="text-primary fw-bold" style="letter-spacing: 2px;"><?= htmlspecialchars($_SESSION['RMAQreference_code']) ?></h4>
    <p class="mt-4 text-muted">You will be redirected to the login page in 1 minute.</p>
    <footer class="mt-5">
        <small>© 2025 Powered by UST Computer Science Society</small>
    </footer>
</body>
</html>
