<?php
session_start();
require '../../db_connection/db_connection.php'; 

$user_id = $_SESSION['user_id'];
$total = $_SESSION["total"];
$orderStatus = 'Pending approval';
$discount = 0;
$discounted_total = $total;

function place_order($userID, $total, $orderStatus){
  global $pdo;
  $query = "INSERT INTO `orders` (userID, total, orderStatus) VALUES (:userId, :total, :orderStatus)";
  $stmt = $pdo->prepare($query);
  
  $stmt->bindParam(':userId', $userID, PDO::PARAM_INT);
  $stmt->bindParam(':total', $total, PDO::PARAM_STR);
  $stmt->bindParam(':orderStatus', $orderStatus, PDO::PARAM_STR);
  
  // Execute the query
  $stmt->execute();
  unset($_SESSION['cart']); 
  unset($_SESSION['total']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_now'])) {
        // Regular form submission
        try {
            $stmt = $pdo->prepare("SELECT * FROM orders WHERE userID = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $orders = $stmt->fetchAll();
            if (count($orders) % 20 == 0) {
                $discounted_total = 0.8 * $total;
                $discount = $total - $discounted_total;
            } elseif (count($orders) % 10 == 0) {
                $discounted_total = 0.9 * $total;
                $discount = $total - $discounted_total;
            } else {
                $discounted_total = $total;
                $discount = $total - $discounted_total;
            }
            place_order($user_id, $discounted_total, $orderStatus);
            
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
        }

        // Redirect after processing
        header("Location: ../../pages/orderConfirmation.php");
        exit();
    } elseif ($_SERVER['CONTENT_TYPE'] === 'application/json') {
        // Handle AJAX request
        try {
            $stmt = $pdo->prepare("SELECT * FROM orders WHERE userID = :user_id");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $orders = $stmt->fetchAll();
            if (count($orders) % 5 == 0) {
                $discounted_total = 0.8 * $total;
                $discount = $total - $discounted_total;
            } elseif (count($orders) % 2 == 0) {
                $discounted_total = 0.9 * $total;
                $discount = $total - $discounted_total;
            } else {
                $discounted_total = $total;
                $discount = $total - $discounted_total;
            }

            echo json_encode([
                'discount' => number_format($discount, 2),
                'discounted_total' => number_format($discounted_total, 2)
            ]);
            exit();
        } catch (PDOException $e) {
            $error_message = "Error: " . $e->getMessage();
            echo json_encode(['error' => $error_message]);
        }
    }
}
?>
