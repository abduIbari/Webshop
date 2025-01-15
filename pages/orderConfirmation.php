<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../styling/mystyle.css">
    <script src="../js/darkMode.js" defer></script> 
    <script src="../js/cart.js" defer></script>
</head>
<body>
    <header>
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

    <main class="order-confirmation">
        <div class="confirmation-container">
            <h1>Order Confirmed!</h1>
            <p>Thank you for your order. Your order is now being processed.</p>
            <a href="index.php">
            <button class="auth-button">Continue Shopping</button>
            </a>
        </div>
    </main>

</body>
</html>
