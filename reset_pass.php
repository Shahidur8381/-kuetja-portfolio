<?php
require_once 'db.php';
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password = :pass WHERE username = 'admin'");
$stmt->execute(['pass' => $hash]);

if ($stmt->rowCount() > 0) {
    echo "Password reset to admin123 successfully! Hash: $hash";
} else {
    echo "No matching user found. Attempting to insert...<br>";
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES ('admin', :pass)");
    if ($stmt->execute(['pass' => $hash])) {
        echo "Admin user created successfully with password admin123!";
    }
}
?>