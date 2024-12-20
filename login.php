<?php
session_start();
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier']; // Can be username or email
    $password = $_POST['password'];

    // Query for user by username or email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$identifier, $identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
       
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; 

     
        if ($user['role'] === 'admin') {
         
            header("Location: admin.php");
        } else {
        
            header("Location: dashboardApp.php");
        }
        exit(); 
    } else {
        echo "Invalid username/email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samarinians Clinic - Login</title>
    <link rel="stylesheet" href="login.css">
    
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/Slogo.png" alt="Samarinians Clinic" height="50" weight="55">
            <span class="title">SAMARINIANS DENTAL CLINIC</span>
        </div>
   
    </header>
    <main>
        <div class="container">
            <form method="POST" action="login.php">
                <h2>Log In</h2>
                <input type="text" name="identifier" placeholder="Username or E" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Log In</button>
            </form>
            <a href="signup.php"><button class="signup-btn">Sign Up</button></a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Samarinians Clinic. All rights reserved.</p>
    </footer>
</body>
</html>
