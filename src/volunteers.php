<?php
include 'config/db.php';
include 'includes/header.php';

// Access Control: Only NGOs (and Admins) can see volunteers
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'ngo' && $_SESSION['role'] !== 'admin')) {
    echo "<div class='alert alert-warning'>Access Restricted: Only NGO clients can view specialists.</div>";
    include 'includes/footer.php';
    exit();
}

// Fetch all Volunteers
$stmt = $pdo->prepare("SELECT users.email, profiles.* FROM users 
                       JOIN profiles ON users.id = profiles.user_id 
                       WHERE users.user_type = 'volunteer'");
$stmt->execute();
$volunteers = $stmt->fetchAll();
?>

<h2>Cybersecurity Specialists</h2>
<p class="text-muted">Connect with experts ready to help your non-profit.</p>

<div class="row">
    <?php foreach ($volunteers as $v): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($v['full_name']); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $v['hours_per_week']; ?> hrs/week available</h6>
                <p class="card-text">Status: 
                    <span class="badge <?php echo $v['background_check'] ? 'bg-success' : 'bg-secondary'; ?>">
                        <?php echo $v['background_check'] ? 'Background Checked' : 'Pending Review'; ?>
                    </span>
                </p>
                
                <?php 
                    $subject = rawurlencode("GuardianLink: Request for Cybersecurity Assistance");
                    $body = rawurlencode("Hello " . $v['full_name'] . ",\n\nWe saw your profile on GuardianLink and would like to discuss a project...");
                ?>
                <a href="mailto:<?php echo $v['email']; ?>?subject=<?php echo $subject; ?>&body=<?php echo $body; ?>" 
                   class="btn btn-primary w-100">Contact Volunteer</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>