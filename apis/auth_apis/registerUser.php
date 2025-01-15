<?php
session_start();
require '../../db_connection/db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $role = $_POST['role'];
    $error_message = "";

    if ($password === $confirm_password){
      try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role, active, blocked) 
                                   VALUES (:username, :password, :role, 0, 0)");
            
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':role', $role);

            $stmt->execute();

            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            header("Location: ../pages/auth/login.php"); 
            exit;

        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    } else {
      $error_message = "Passwords do not match!";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../../styling/mystyle.css">
    <script src="../../js/darkMode.js" defer></script>
</head>
<body>
    <nav>
        <a href="../../pages/index.php" class="tomorrow-extralight">
            MBW
        </a>
        <i class="material-symbols-outlined" id="toggleDark">contrast</i>
    </nav>
    <main>
    <div class="status-container">
        <h2>Error registering</h2>

        <!-- Display status message -->
        <div class="status-message">
            <p><?php echo htmlspecialchars($error_message); ?></p>
        </div>

        <!-- Button to go back to homepage -->
        <div class="buttons-foot">
            <a href="../../pages/index.php">
                <button class="auth-button">Go to Homepage</button>
            </a>
        </div>
    </div>
</main>
</body>
</html>