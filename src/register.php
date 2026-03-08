<?php 
include 'includes/header.php'; 
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure Hashing
    $role = $_POST['role'];

    // 1. Insert into core 'users' table
    $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, user_type) VALUES (?, ?, ?)");
    $stmt->execute([$email, $password, $role]);
    $userId = $pdo->lastInsertId();

    // 2. Insert into 'profiles' table based on role
    if ($role == 'ngo') {
        $stmt = $pdo->prepare("INSERT INTO profiles (user_id, organization_name, areas_of_concern) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $_POST['org_name'], $_POST['concerns']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO profiles (user_id, full_name, hours_per_week) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $_POST['full_name'], $_POST['hours']]);
    }
    
    echo "<div class='alert alert-success'>Registration successful! <a href='login.php'>Login here</a></div>";
}
?>

<h2>Join GuardianLink</h2>
<form method="POST" action="register.php" class="mt-4">
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>I am a:</label>
        <select name="role" id="roleSelect" class="form-control" onchange="toggleFields()">
            <option value="volunteer">Cybersecurity Volunteer</option>
            <option value="ngo">NGO / Non-Profit</option>
        </select>
    </div>

    <div id="volunteerFields">
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Hours Available per Week</label>
            <input type="number" name="hours" class="form-control">
        </div>
    </div>

    <div id="ngoFields" style="display:none;">
        <div class="mb-3">
            <label>Organization Name</label>
            <input type="text" name="org_name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Areas of Concern</label>
            <textarea name="concerns" class="form-control"></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>

<script>
function toggleFields() {
    const role = document.getElementById('roleSelect').value;
    document.getElementById('volunteerFields').style.display = role === 'volunteer' ? 'block' : 'none';
    document.getElementById('ngoFields').style.display = role === 'ngo' ? 'block' : 'none';
}
</script>

<?php include 'includes/footer.php'; ?>