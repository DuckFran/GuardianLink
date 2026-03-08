<?php include 'includes/header.php'; ?>

<div class="p-5 mb-4 bg-light border rounded-3 text-center">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-primary">Securing the Non-Profit World</h1>
        <p class="col-md-12 fs-4">GuardianLink connects elite cybersecurity volunteers with organizations that need them most—at zero cost.</p>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="register.php" class="btn btn-primary btn-lg">Join the Mission</a>
        <?php endif; ?>
    </div>
</div>

<div class="row g-4 py-5">
    <div class="col-md-4">
        <h3>Who are we?</h3>
        <p>GuardianLink is a platform born from a secure software program initiative to ensure that budget constraints never leave a non-profit vulnerable to cyber threats.</p>
    </div>
    <div class="col-md-4">
        <h3>What do we do?</h3>
        <p>We provide a secure directory where NGOs can find verified specialists to help with audits, incident response, and network hardening.</p>
    </div>
    <div class="col-md-4">
        <h3>Why do we do it?</h3>
        <p>Non-profits handle sensitive data but often lack the resources to protect it. We believe security is a right, not a luxury.</p>
    </div>
</div>

<hr>

<div class="py-5">
    <h3 class="text-center mb-4">Our Partners</h3>
    <div class="row text-center grayscale">
        <div class="col-3"><strong>ShieldSoft (Fake)</strong></div>
        <div class="col-3"><strong>SecurePaths (Fake)</strong></div>
        <div class="col-3"><strong>CyberDefense NGO (Fake)</strong></div>
        <div class="col-3"><strong>NetWatchers (Fake)</strong></div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>