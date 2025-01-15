<?php
session_start();
require "../../db_connection/db_connection.php";


$stmt = $pdo->prepare("SELECT * FROM orders");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../../styling/mystyle.css">
    <script src="../../js/darkMode.js" defer></script> 
    <script src="../../js/admin.js" defer></script>

</head>
<body>

      <nav>
        <a href="adminDashboard.php" class="tomorrow-extralight">
          MBW
        </a>
        <div class="nav-icons">
            <a href="../customer.php">
              <span class="material-symbols-outlined">person</span>
            </a>
            <a href="manageUsers.php">
              <span class="material-symbols-outlined">manage_accounts</span>
            </a>
            <a href="../auth/logout.php">
              <span class="material-symbols-outlined">logout</span>
            </a>
            <i class="material-symbols-outlined" id="toggleDark">contrast</i>
        </div>
        </nav>

        <main class="checkout-page">
    <h1>Admin Dashboard - Orders</h1>
    
    <?php if (!empty($orders)): ?>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Total</th>
                    <th>Order Status</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['orderID']; ?></td>
                        <td><?= $order['userID']; ?></td>
                        <td>$<?= $order['total']; ?></td>
                        <td id="td-order-status-<?= htmlspecialchars($order['orderID']); ?>"><?= $order['orderStatus']; ?></td>
                        <td>
                          <select name="orderStatus" id="orderStatus" class="auth-button" data-orderID="<?= $order['orderID']; ?>">
                              <option value="Pending approval" <?= $order['orderStatus'] == 'Pending approval' ? 'selected' : ''; ?>>Pending Approval</option>
                              <option value="Approved" <?= $order['orderStatus'] == 'Approved' ? 'selected' : ''; ?>>Approved</option>
                              <option value="Dispatched" <?= $order['orderStatus'] == 'Dispatched' ? 'selected' : ''; ?>>Dispatched</option>
                              <option value="Completed" <?= $order['orderStatus'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                              <option value="Cancelled" <?= $order['orderStatus'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                          </select>
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
