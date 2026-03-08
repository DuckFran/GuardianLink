<?php
// config/db.php
$host = 'db'; // This matches the service name in docker-compose.yml
$db   = 'guardianlink_db';
$user = 'guardian_user';
$pass = 'secure_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // In a production environment, don't show the error message to the user
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>