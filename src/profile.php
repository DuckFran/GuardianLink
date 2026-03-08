<?php
include 'config/db.php';
include 'includes/header.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch combined User and Profile data
$stmt = $pdo->prepare("SELECT * FROM users JOIN profiles ON users.id = profiles.user_id WHERE users.id = ?");
$stmt->execute([$userId]);
$profile = $stmt->fetch();

// Logic for deleting own account
if (isset($_POST['delete_account'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>My Profile (<?php echo ucfirst($profile['user_type']); ?>)</h3>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($profile['email']); ?></p>

            <?php if ($profile['user_type'] == 'ngo'): ?>
                <p><strong>Organization:</strong> <?php echo htmlspecialchars($profile['organization_name']); ?></p>
                <p><strong>Areas of Concern:</strong> <?php echo nl2br(htmlspecialchars($profile['areas_of_concern'])); ?></p>
            <?php else: ?>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($profile['full_name']); ?></p>
                <p><strong>Availability:</strong> <?php echo $profile['hours_per_week']; ?> hours/week</p>
                <p><strong>Background Check:</strong> <?php echo $profile['background_check'] ? 'Verified' : 'Pending'; ?></p>
            <?php endif; ?>

            <hr>
            <div class="d-flex justify-content-between">
                <button class="btn btn-secondary">Edit Information</button>
                
                <form method="POST" onsubmit="return confirm('Are you sure? This cannot be undone.');">
                    <button type="submit" name="delete_account" class="btn btn-danger">Delete My Account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>