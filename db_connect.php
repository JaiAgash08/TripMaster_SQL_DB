<?php
// db_connect.php

$host = "localhost";      // Database host (usually localhost)
$dbname = "tripmaster_db"; // Name of the database
$username = "root";        // Database username
$password = "";            // Database password (leave empty for default setup)

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, show error
    die("Connection failed: " . $e->getMessage());
}
?>
