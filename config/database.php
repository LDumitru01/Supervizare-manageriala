<?php
// config/database.php

// Detectăm mediul: local (XAMPP) sau producție (cPanel)
if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    // 🖥️ LOCAL – XAMPP
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = ''; // parolă goală în XAMPP, dacă nu ai schimbat-o
    $DB_NAME = 'supervizare_manageriala'; // exact cum apare în phpMyAdmin
} else {
    // 🌐 PROD – cPanel (datele tale reale de pe hosting)
    $DB_HOST = 'localhost';
    $DB_USER = 'integrae_user';
    $DB_PASS = 'XukLX%+4q~&"6T*';   // parola pe care o ai la user în cPanel
    $DB_NAME = 'integrae_contact_form'; // sau numele corect al DB-ului de pe hosting
}

// Creeăm conexiunea
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Verificăm eroarea de conexiune
if ($mysqli->connect_errno) {
    die('Eroare conexiune DB: ' . $mysqli->connect_error);
}

// Setăm charset-ul
$mysqli->set_charset('utf8mb4');
