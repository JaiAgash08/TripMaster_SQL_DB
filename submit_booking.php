<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost"; // Your database server (usually localhost)
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "tripmaster_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $tour = $_POST['tour'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $days = $_POST['days'];
    $message = $_POST['message'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO bookings (tour, name, email, date, days, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $tour, $name, $email, $date, $days, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to booking confirmation page
        header("Location: booking-confirmed.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
