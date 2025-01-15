<?php
session_start();

// Decode the JSON request
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['pid'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid product ID']);
    exit;
}

$pid = $data['pid'];
$new_quantity = $data['newQuantity'];

if (isset($_SESSION['cart'][$pid])) {
  if ($new_quantity > 0) {
      $_SESSION['cart'][$pid]['quantity'] = $new_quantity;
  } else {
      unset($_SESSION['cart'][$pid]);
  }
}

$total = 0;
$totalItems = 0;
$taxRate = 0.19;
foreach ($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
    $total += $item['price'] * $item['quantity'];
    $subtotal = $item[$pid] * $item[$pid]['quantity'];
}
$taxes = $taxRate * $total;
$totalWithTaxes = $total + $taxes;

echo json_encode([
    'success' => true,
    'total' => $total,
    'totalItems' => $totalItems,
    'updated_cart' => $_SESSION['cart'],
    "taxes" => $taxes,
    "totalWithTaxes" => $totalWithTaxes
]);
?>
