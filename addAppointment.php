<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch user's active appointments
//$stmt = $pdo->prepare("SELECT * FROM appointments WHERE user_id = ? AND status != 'completed'");
//$stmt->execute([$userId]);
//$appointments = $stmt->fetchAll();

// Create new appointment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $number = $_POST['phone_number'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $date = $_POST['appointment_date'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO appointments (user_id, name, phone_number, age, address, appointment_date, description) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $name, $number, $age, $address, $date, $description]);
    header("Location: dashboardApp.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - New Appointment </title>
    <link rel="stylesheet" href="addapp.css">
    <link rel="icon" type="image/x-icon" href="images/Slogo.png">
</head>
<body>

<img src="images/Slogo.png" alt="Clinic Logo" class="logo">
    <main>
        <div class="container">
            <h2>NEW APPOINTMENT</h2>
            <form method="POST" action="addAppointment.php">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="text" name="phone_number" placeholder="Contact Number" required>
                <input type="number" name="age" placeholder="Age" required>
                <textarea name="address" placeholder="Address" required></textarea>
                <input type="datetime-local" name="appointment_date" required>
                <input type="text" name="description" placeholder="Description" required>
                <button type="submit">Add Appointment</button>
            </form>

<a href="logout.php"><button type="button">Log Out</button></a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Samarinians Clinic. All rights reserved.</p>
    </footer>
    
</body>
</html>
