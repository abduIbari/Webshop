<?php
session_start();

// Fetch cart details from session
$cart = $_SESSION['cart'] ?? [];
$total = 0;

// Calculate the total price
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
} 

$taxes = 0.19 * $total;
$total_with_taxes = $total + $taxes;

$_SESSION["total"] = $total_with_taxes
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../styling/mystyle.css">
    <script src="../js/darkMode.js" defer></script> 
    <script src="../js/cart.js" defer></script>
</head>
<body>
    <header>
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

    </header>

    <main class="checkout-page">
        <div class="checkout-container">
            <h1>Checkout</h1>
            <div id="orderSummary" class="order-summary">
                <h2>Order Summary</h2>
                <ul>
                    <?php foreach ($cart as $item): ?>
                        <li>
                            <?= htmlspecialchars($item['name']) ?> - 
                            <?= $item['quantity'] ?> x $<?= number_format($item['price'], 2) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p>Subtotal: $<?= number_format($total, 2) ?></p>
                <p>Taxes (19%): $<?= number_format($taxes, 2) ?></p>
                <p><strong>Total: $<?= number_format($total_with_taxes, 2) ?></strong></p>
            </div>
            <form method="POST" action="../apis/shopping_cart_apis/placeOrder.php">
                <button type="submit" name="order_now" class="auth-button">Order now</button>
            </form>
        </div>

    </main>
</body>
</html>
