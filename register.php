<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Voting System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container mx-auto w-75">
        <h3 class="text-center text-primary">Voter Registration</h3>
        <form action="register_process.php" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="RMAQname" class="form-label">Full Name</label>
                    <input type="text" name="RMAQname" class="form-control" id="RMAQname" required>
                </div>
                <div class="col-md-6">
                    <label for="RMAQdob" class="form-label">Date of Birth</label>
                    <input type="date" name="RMAQdob" class="form-control" id="RMAQdob" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="RMAQgender" value="Male" id="genderMale" required>
                        <label class="form-check-label" for="genderMale">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="RMAQgender" value="Female" id="genderFemale" required>
                        <label class="form-check-label" for="genderFemale">Female</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="RMAQcontact" class="form-label">Contact Number</label>
                    <input type="text" name="RMAQcontact" class="form-control" id="RMAQcontact" required>
                </div>
                <div class="col-md-6">
                    <label for="RMAQemail" class="form-label">Email</label>
                    <input type="email" name="RMAQemail" class="form-control" id="RMAQemail" required>
                </div>
                <div class="col-md-6">
                    <label for="RMAQusername" class="form-label">Username</label>
                    <input type="text" name="RMAQusername" class="form-control" id="RMAQusername" required>
                </div>
                <div class="col-md-6">
                    <label for="RMAQpassword" class="form-label">Password</label>
                    <input type="password" name="RMAQpassword" class="form-control" id="RMAQpassword" required>
                </div>
                <div class="col-md-6">
                    <label for="RMAQrole" class="form-label">Role</label>
                    <select name="RMAQrole" class="form-select" id="RMAQrole" required>
                        <option value="Admin">Admin</option>
                        <option value="Organizer">Organizer</option>
                        <option value="Voter" selected>Voter</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">Register & Send OTP</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
