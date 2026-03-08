<?php
include 'config/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Securely fetch user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify password against hashed version in DB
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['user_type'];
        $_SESSION['email'] = $user['email'];
        
        header("Location: profile.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-4">
        <h2 class="text-center">Login</h2>
        <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
        <p class="mt-3 text-center"><a href="forgot_password.php">Forgot Password?</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>