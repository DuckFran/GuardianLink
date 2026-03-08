<?php
include 'config/db.php';
include 'includes/header.php';

// Access Control: Only Volunteers (and Admins) can see NGOs
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'volunteer' && $_SESSION['role'] !== 'admin')) {
    echo "<div class='alert alert-warning'>Access Restricted: Only Volunteers can view NGO requests.</div>";
    include 'includes/footer.php';
    exit();
}

// Fetch all NGOs
$stmt = $pdo->prepare("SELECT users.email, profiles.* FROM users 
                       JOIN profiles ON users.id = profiles.user_id 
                       WHERE users.user_type = 'ngo'");
$stmt->execute();
$ngos = $stmt->fetchAll();
?>

<h2>NGOs Seeking Assistance</h2>
<p class="text-muted">The following organizations have requested cybersecurity support.</p>

<div class="row">
    <?php foreach ($ngos as $n): ?>
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-primary">
            <div class="card-body">
                <h5 class="card-title text-primary"><?php echo htmlspecialchars($n['organization_name']); ?></h5>
                <p class="card-text"><strong>Security Concerns:</strong><br>
                <?php echo nl2br(htmlspecialchars($n['areas_of_concern'])); ?></p>
                
                <a href="mailto:<?php echo $n['email']; ?>?subject=Volunteer Assistance Offer" 
                   class="btn btn-outline-primary">Offer Support</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'includes/footer.php'; ?>