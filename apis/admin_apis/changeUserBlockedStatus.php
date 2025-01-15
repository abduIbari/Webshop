<?php
session_start();
require '../../db_connection/db_connection.php'; 

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['userID'], $data['newStatus'])) {
    http_response_code(400);
    exit;
}


$userID = $data['userID'];
$newStatus = $data['newStatus'] === "Blocked" ? 1 : 0;

try {
$query = "UPDATE users SET blocked = :newStatus WHERE userID = :userID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':userID', $userID);
$stmt->bindParam(':newStatus', $newStatus);
$stmt->execute();

} catch (PDOException $e) {
  $error_message = "Error: " . $e->getMessage();
}


echo json_encode([
  'newStatus' => $newStatus == 1 ?  "Blocked" : "Unblocked"
]);

?>
