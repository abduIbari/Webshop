<?php
session_start(); 
require "../../db_connection/db_connection.php";

$data = json_decode(file_get_contents('php://input'), true);
$product_string = strtolower($data['productString']);

if (!$data || !isset($product_string)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid product string']);
    exit;
}

$search_term = "%".$product_string."%";

$query = "SELECT * FROM Products WHERE LOWER(name) LIKE :product_string";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':product_string', $search_term, PDO::PARAM_STR);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
  'matching_products' => $products
]);


?>
