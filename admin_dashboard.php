<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_signin.php");
    exit();
}

// Database connection
include 'db_connect.php';

// Fetch user information with their bookings
$stmt = $conn->prepare("
    SELECT u.user_id, u.name AS user_name, u.email AS user_email, 
           b.tour, b.date, b.days 
    FROM users u
    LEFT JOIN bookings b ON u.email = b.email
");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Tour</th>
            <th>Date of Trip</th>
            <th>Number of Days</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['user_id']) ?: 'N/A'; ?></td>
            <td><?php echo htmlspecialchars($user['user_name']); ?></td>
            <td><?php echo htmlspecialchars($user['user_email']); ?></td>
            <td><?php echo isset($user['tour']) ? htmlspecialchars($user['tour']) : 'No Booking'; ?></td>
            <td><?php echo isset($user['date']) ? htmlspecialchars($user['date']) : 'N/A'; ?></td>
            <td><?php echo isset($user['days']) ? htmlspecialchars($user['days']) : 'N/A'; ?></td>
            <td><a href='mailto:<?php echo htmlspecialchars($user['user_email']); ?>'>Contact User</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="admin_logout.php">Logout</a>
</body>
</html>
