<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
$total = array_sum(array_map(function ($item) {
    return $item['price'] * $item['quantity'];
}, $cart));

$db = new PDO('mysql:host=localhost;dbname=webshop', 'root', '');
$stmt = $db->prepare("INSERT INTO orders (user_id, items, total) VALUES (?, ?, ?)");
$stmt->execute([$_SESSION['user']['id'], json_encode($cart), $total]);

unset($_SESSION['cart']);
header('Location: confirmation.php');
exit;
