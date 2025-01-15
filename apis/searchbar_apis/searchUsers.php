<?php
session_start(); 
require "../../db_connection/db_connection.php";

$data = json_decode(file_get_contents('php://input'), true);
$user_string = strtolower($data['userString']);


if (!$data || !isset($user_string)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid user string']);
    exit;
}

$search_term = "%".$user_string."%";

$query = "SELECT * FROM users WHERE LOWER(username) LIKE :user_string";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_string', $search_term, PDO::PARAM_STR);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
  'matching_users' => $users
]);


?>
