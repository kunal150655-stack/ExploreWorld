<?php
// Update these values to match your local MySQL setup.
$host = "localhost";
$dbname = "wonderworld";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    exit("Database connection failed. Check config.php and import database.sql.");
}
if (session_status() === PHP_SESSION_NONE) session_start();

function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function logged_in() { return !empty($_SESSION['user_id']); }
function is_admin() { return !empty($_SESSION['is_admin']); }
