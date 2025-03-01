<?php
session_start();
    $companyName = "MBW Electronics";
    $description1 = "Welcome to <strong>$companyName</strong>, your one-stop shop for the latest in laptops, phones, and top-quality tech accessories! We’re passionate about bringing cutting-edge technology to our customers, whether you’re a student, professional, gamer, or simply a tech enthusiast. Our carefully curated selection includes the latest models from top brands, all at competitive prices.";
    $description2 = "At <strong>$companyName</strong>, we pride ourselves on more than just products. Our team is here to provide expert advice, fast shipping, and exceptional customer support to ensure you have the best shopping experience. We understand that finding the right tech can be overwhelming, so we’re committed to helping you choose products that perfectly fit your needs, lifestyle, and budget.";
    $description3 = "Thank you for choosing <strong>$companyName</strong>. Explore our catalog today and step into a world of technology that inspires and empowers!";    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../styling/mystyle.css">
    <script src="../js/darkMode.js" defer></script>
    <script src="../jscart.js" defer></script>

    <!-- Task 1
    <link rel="stylesheet" href="firstyle.css"> -->
</head>

<body class="about-page">

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

    <main>
        <div class="about-container">
            <h2>About Us</h2>

            <div class="about-description">
                <p><?php echo $description1; ?></p>
                <p><?php echo $description2; ?></p>
                <p><?php echo $description3; ?></p>
            </div>
        </div>
    </main>

</body>

</html>