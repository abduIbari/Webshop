<?php
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
    <link rel="stylesheet" href="./mystyle.css">
</head>
<body>
    <header>
    <nav>
            <a href="index.php" class="tomorrow-extralight">
                MBW
            </a>
            <div class="nav-icons">
                <a href="about.php">About us</a>
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
                    <?php foreach ($cart as $id => $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <li class="cart-item">
                        <div class="item-details">
                            <span class="item-name"><?= htmlspecialchars($item['name']) ?></span>
                            <span class="item-price">$<?= number_format($item['price'], 2) ?></span>
                        </div>
                        <div class="item-actions">
                            <form action="updateCart.php" method="post">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="quantity-input">
                                <button type="submit" class="auth-button">Update</button>
                            </form>
                            <form action="removeFromCart.php" method="post">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" class="auth-button remove-button">Remove</button>
                            </form>
                        </div>
                        <span class="item-subtotal">Subtotal: $<?= number_format($subtotal, 2) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div class="cart-summary">
                    <p>Total: $<?= number_format($total, 2) ?></p>
                    <a href="checkout.php" class="auth-button">Proceed to Checkout</a>
                </div>
            <?php else: ?>
                <p class="empty-cart">Your shopping cart is empty!</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
