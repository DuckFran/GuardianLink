<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GuardianLink | Secure Connections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">GuardianLink</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">About</a></li>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if($_SESSION['role'] == 'ngo'): ?>
                        <li class="nav-item"><a class="nav-link" href="volunteers.php">Find Specialists</a></li>
                    <?php endif; ?>

                    <?php if($_SESSION['role'] == 'volunteer'): ?>
                        <li class="nav-item"><a class="nav-link" href="ngos.php">Find NGOs</a></li>
                    <?php endif; ?>

                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link text-warning" href="admin.php">Admin Panel</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <div class="d-flex">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="profile.php" class="btn btn-outline-light me-2">My Profile</a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                    <a href="register.php" class="btn btn-primary">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container mt-4">