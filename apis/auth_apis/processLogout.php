<?php
session_start(); 
require "../../db_connection/db_connection.php";

$user_id = $_SESSION['user_id'];
$login_status = 0;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  try {
    $query = "UPDATE users SET active = :login_status WHERE userID = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':login_status', $login_status, PDO::PARAM_BOOL);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    
  } catch (PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
  }
  
  session_unset(); 
  session_destroy();
  
  header("Location: ../../pages/auth/logout.php");
  exit();
}
?>
