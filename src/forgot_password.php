<?php
include 'config/db.php';
include 'includes/header.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Securely check if user exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // To prevent User Enumeration, we show the same message 
    // regardless of whether the email was found or not.
    $message = "If an account exists with that email, a reset request has been sent to the Administrator.";
    
    // In a real app, you'd insert a token into a 'password_resets' table here.
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm mt-5">
            <div class="card-body p-5">
                <h2 class="text-center mb-4">Forgot Password</h2>
                
                <?php if($message): ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>

                <p class="text-muted text-center">
                    Enter your email address and we will notify the Admin to reset your password.
                </p>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Request Reset</button>
                </form>

                <div class="mt-3 text-center">
                    <a href="login.php" class="text-decoration-none">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>