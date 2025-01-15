<?php
session_start();
require '../../db_connection/db_connection.php'; 

$user_id = $_SESSION['user_id'];
$response = ['loginStatus' => 0];

try {
  $stmt = $pdo->prepare("SELECT * FROM users WHERE userID = :user_id");
  $stmt->bindParam(':user_id', $user_id);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  $login_status = (bool)$user["active"];

} catch (PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
}

echo json_encode([
    'loginStatus' => $login_status,
]);
?>
