<?php
session_start();
require "../db_connection/db_connection.php";
$user_id = $_SESSION["user_id"];


$stmt = $pdo->prepare("SELECT * FROM orders WHERE userID = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../styling/mystyle.css">
    <script src="../js/darkMode.js" defer></script> 
    <script src="../js/cancelOrders.js" defer></script>

</head>
<body>

      <nav>
        <a href="index.php" class="tomorrow-extralight">
          MBW
        </a>
        <div class="nav-icons">
            <a href="customer.php">
              <span class="material-symbols-outlined">person</span>
            </a>
            <i class="material-symbols-outlined" id="toggleDark">contrast</i>
        </div>
        </nav>

        <main class="checkout-page">
    <h1>My Orders</h1>
    
    <?php if (!empty($orders)): ?>
        <table class="orders-table">
            <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Total</th>
                  <th>Order Status</th>
                  <th>Cancel Order</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['orderID']; ?></td>
                        <td>$<?= $order['total']; ?></td>
                        <td id="td-user-order-status-<?= $order['orderID']; ?>"><?= $order['orderStatus']; ?> </td>
                        <td>
                          <button id="td-user-order-cancel"
                                  class="auth-button"
                                  data-userID="<?= $order['userID']; ?>"
                                  data-orderID="<?= $order['orderID']; ?>">Cancel Order</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
    </main>
</body>
</html>
