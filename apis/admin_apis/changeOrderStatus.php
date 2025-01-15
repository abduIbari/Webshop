<?php
session_start();
require '../../db_connection/db_connection.php'; 

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['orderID'], $data['newStatus'])) {
    http_response_code(400);
    exit;
}

$orderID = $data['orderID'];
$newStatus = $data['newStatus'];
try {
$query = "UPDATE orders SET orderStatus = :newStatus WHERE orderID = :orderID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':orderID', $orderID);
$stmt->bindParam(':newStatus', $newStatus);
$stmt->execute();

} catch (PDOException $e) {
  $error_message = "Error: " . $e->getMessage();
}


echo json_encode([
  'newStatus' => $newStatus
]);

?>
