<?php
include("db_connection.php");
session_start();
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../styling/mystyle.css">
    <script src="../js/darkMode.js" defer></script> 
    <script src="../js/cart.js" defer></script>

</head>
<body class="shopping-cart-page">
    <header>
    <nav>
            <a href="index.php" class="tomorrow-extralight">
                MBW
            </a>
            <div class="nav-icons">
                <a href="customer.php">
                    <span class="material-symbols-outlined">person</span>
                </a>
                <a href="auth/login.php">
                    <span class="material-symbols-outlined">login</span>
                </a>
                <a href="shoppingCart.php" id="cart-link">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span id="cart-count">0</span>
                </a>
                <i class="material-symbols-outlined" id="toggleDark">contrast</i>
            </div>
        </nav>

    </header>
    <main>
        <div class="shopping-cart-container">
            <h1>Shopping Cart</h1>
            <?php if (!empty($cart)): ?>
                <ul class="cart-items">
                    <?php foreach ($cart as $pid => $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                        $taxes = 0.19 * $total;
                        $total_with_taxes = $total + $taxes;
                    ?>
                    <li class="cart-item" data-item="<?= $pid ?>">
                        <div class="item-details">
                          <span class="item-name"><?= $item['name'] ?></span>
                          <span class="item-price">$<?= number_format($item['price'], 2) ?></span>
                        </div>
                        <div class="item-actions">
                            <form action="../apis/shopping_cart_apis/rempoveProduct.php" method="post">
                                <input type="hidden" name="pid" value="<?= $pid ?>"> 
                                <button type="submit" class="auth-button remove-button" data-pid="<?=$pid ?>">Remove</button>
                            </form>
                            <form action="../apis/shopping_cart_apis/updateCart.php" method="post">
                                <input type="hidden" name="pid" value="<?= $pid ?>"> 
                                <div>
                                  <label for="quantity">Quantity:</label>
                                  <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="quantity-input" data-pid="<?=$pid ?>">
                                </div>
                                <button type="submit" class="auth-button update-button" data-pid="<?=$pid ?>">Update</button>
                            </form>
                        </div>
                        <span class="item-subtotal" data-pid="<?=$pid ?>">Subtotal: $<?= number_format($subtotal, 2) ?></span>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                  <div class="cart-summary">
                    <p id="cart-total">Total: $<?= number_format($total, 2) ?></p>
                    <p id="cart-taxes">Taxes: $<?= number_format($taxes, 2) ?></p>
                    <p id="cart-total-with-taxes">Total with taxes: $<?= number_format($total_with_taxes, 2) ?></p>
                    <button id="buyNowBtn" class="auth-button">Buy now</a>
                  </div>
            <?php else: ?>
                <p class="empty-cart">Your cart is empty!</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>