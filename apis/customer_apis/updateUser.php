<?php
session_start();
require '../../db_connection/db_connection.php'; 

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];

$error_message = "";
$success_message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $new_username = $_POST['changeUsername'] ?? '';
  $new_password = $_POST['changePassword'] ?? '';

  if ($new_username && $new_username !== $username){
    try{
      $query = "SELECT COUNT(*) FROM users WHERE username = :username";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':username', $new_username, PDO::PARAM_STR);
      $count = $stmt->fetchColumn();
      $stmt->execute();
      
      if ($count > 0){
        $error_message = "username already taken";
      }
      else{
        $query = "UPDATE users SET username = :new_username WHERE userID = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':new_username', $new_username, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['username'] = $new_username; 
        $success_message = "Username updated successfully!";
      }
    }
    catch (PDOException $e) {
      $error_message = "Error: " . $e->getMessage();
    }
  }

  if ($new_password && $new_password !== $password){
    try{
        $query = "UPDATE users SET password = :new_password WHERE userID = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':new_password', $new_password, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['password'] = $new_password; 
        $success_message = "Password updated successfully!";
      }
      catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Information</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styling/mystyle.css">
    <script src="../../js/formValidation.js" defer></script>
    <script src="../../js/task2script.js" defer></script>
    <script src="../../js/cart.js" defer></script>
</head>
<body>
        <nav>
            <a href="../../pages/index.php" class="tomorrow-extralight">
                MBW
            </a>
            <div class="nav-icons">
                <a href="../../pages/about.php">About us</a>
                <a href="../../pages/shoppingCart.php" id="cart-link">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span id="cart-count">0</span>
                </a>
                <i class="material-symbols-outlined" id="toggleDark">contrast</i>
            </div>
        </nav>

    <main>
        <div class="update-container">
            <?php if ($error_message): ?>
                <h1><?= $error_message ?></h1>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <h1><?= $success_message ?></h1>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
