<?php
include 'config/db.php';
include 'includes/header.php';

// STRICT ACCESS CONTROL: Redirect if not an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle Admin Actions: Delete User
if (isset($_GET['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: admin.php?msg=User Deleted");
}

// Handle Admin Actions: Password Reset (Set to a default)
if (isset($_GET['reset_id'])) {
    $newPassword = password_hash('Guardian2026!', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
    $stmt->execute([$newPassword, $_GET['reset_id']]);
    header("Location: admin.php?msg=Password Reset to Guardian2026!");
}

// Fetch all users and their profile info
$stmt = $pdo->query("SELECT users.id, users.email, users.user_type, profiles.organization_name, profiles.full_name 
                     FROM users 
                     LEFT JOIN profiles ON users.id = profiles.user_id");
$allUsers = $stmt->fetchAll();
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Operations</h2>
        <span class="badge bg-danger">Administrator Access</span>
    </div>

    <?php if(isset($_GET['msg'])) echo "<div class='alert alert-info'>{$_GET['msg']}</div>"; ?>

    <table class="table table-hover border">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Role</th>
                <th>Name/Org</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allUsers as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo ucfirst($user['user_type']); ?></td>
                <td>
                    <?php echo htmlspecialchars($user['full_name'] ?: $user['organization_name'] ?: 'N/A'); ?>
                </td>
                <td>
                    <a href="admin.php?reset_id=<?php echo $user['id']; ?>" 
                       class="btn btn-sm btn-warning" 
                       onclick="return confirm('Reset this user\'s password?')">Reset Pass</a>
                    
                    <?php if ($user['user_type'] !== 'admin'): ?>
                        <a href="admin.php?delete_id=<?php echo $user['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Permanently delete this user?')">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>