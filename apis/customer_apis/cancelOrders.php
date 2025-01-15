<?php
session_start();
require '../../db_connection/db_connection.php'; 

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['orderID'])) {
    http_response_code(400);
    exit;
}

$orderID = $data['orderID'];
$userID = $data['userID'];
$stmt = $pdo->prepare("SELECT orderStatus FROM orders WHERE userID = :user_id AND orderID = :order_id");
$stmt->bindParam(':user_id', $userID);
$stmt->bindParam(':order_id', $orderID);
$stmt->execute();

$orderStatus = $stmt->fetchColumn();
$order_cancelled = false;
if ($orderStatus === "Pending approval" || $orderStatus === "Approved"){
  try {
    $newStatus = "Cancelled";
    $query = "UPDATE orders SET orderStatus = :newStatus WHERE orderID = :order_id AND userID = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':newStatus', $newStatus);
    $stmt->bindParam(':user_id', $userID);
    $stmt->bindParam(':order_id', $orderID);
    if ($stmt->execute()) {
      $order_cancelled = true;
  }
  }
  catch (PDOException $e) {
    $error_message = "Error: " . $e->getMessage();
  }

}

echo json_encode([
  'order_cancelled' => $order_cancelled
]);

?>
