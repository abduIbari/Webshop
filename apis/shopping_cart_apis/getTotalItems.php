<?php
session_start();

$totalItems = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
}

echo json_encode([
    'totalItems' => $totalItems,
]);
?>
 