<?php
session_start();
require "../../db_connection/db_connection.php";


$data = json_decode(file_get_contents('php://input'), true);


if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

$pid = $data['pid'];
$name = $data['name'];
$price = $data['price'];

$session_user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT 1 FROM users WHERE userID = ? AND blocked = 1");
$stmt->execute([$session_user_id]);
$user_blocked = $stmt->fetchColumn() ? true : false;

if ($user_blocked) {
    echo json_encode([
        'user_blocked' => true,
        'totalItems' => 0,  
        'cart' => $_SESSION['cart']
    ]);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$pid])) {
    $_SESSION['cart'][$pid]['quantity']++;
} else {
    $_SESSION['cart'][$pid] = [
        'name' => $name,
        'price' => $price,
        'quantity' => 1,
    ];
}

$totalItems = array_sum(array_column($_SESSION['cart'], 'quantity'));

echo json_encode([
    'totalItems' => $totalItems,
    'cart' => $_SESSION['cart'],
    'user_blocked' => $user_blocked
]);
?>