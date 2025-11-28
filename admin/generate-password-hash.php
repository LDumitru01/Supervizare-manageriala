<?php
// Script pentru a genera hash-ul corect pentru parola "admin123"
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Parola: " . $password . "\n";
echo "Hash: " . $hash . "\n";
echo "\nCopiază acest hash în fișierul setup-database.sql:\n";
echo $hash . "\n";

// Verifică dacă hash-ul funcționează
if (password_verify($password, $hash)) {
    echo "\n✓ Hash-ul este valid și funcționează corect!\n";
} else {
    echo "\n✗ Hash-ul nu funcționează corect!\n";
}
?>