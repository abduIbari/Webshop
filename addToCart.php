<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

$pid = $data['pid'];
$name = $data['name'];
$price = $data['price'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$pid])) {
    $_SESSION['cart'][$pid]['quantity']++;
} else {
    $_SESSION['cart'][$pid] = [
        'name' => $name,
        'price' => $price,
        'quantity' => 1
    ];
}

$totalItems = array_sum(array_column($_SESSION['cart'], 'quantity'));
echo json_encode(['totalItems' => $totalItems]);

$_SESSION['cart'][$pid] = [
    'name' => $name,
    'price' => $price,
    'quantity' => 1
];

