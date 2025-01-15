<?php
session_start();
$json_data = file_get_contents("../products.json");
$products = json_decode($json_data, true);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../styling/mystyle.css">
    <script src="../js/darkMode.js" defer></script> 
    <script src="../js/cart.js" defer></script>
    <script src="../js/searchProducts.js" defer></script>

    <!-- Task1 -->
    <!-- <link rel="stylesheet" href="../styling/firstyle.css"> -->

</head> 

<body class="index-page">
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
                <a href="./auth/login.php">
                    <span class="material-symbols-outlined">login</span>
                </a>
                <a id="userOrders1" href="userOrders.php">
                    <span class="material-symbols-outlined">orders</span>
                </a>
                <a href="shoppingCart.php" id="cart-link">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span id="cart-count">0</span>
                </a>
                <i class="material-symbols-outlined" id="toggleDark">contrast</i>
            </div>
        </nav>
        <div class="search-container">
        <div class="search-field">
        <input type="text" id="productSearchInput" class="search-input tomorrow-extralight" name="query" placeholder="Search products..." required>
        <button class="auth-button">
            <span class="material-symbols-outlined">search</span>
        </button>
        </div>
        <div id="matchingProductsContainer"></div>
    </div>
        
        
    </header>

    <main>
        <div><h1 class="tomorrow-extralight">Your destination for premium tech, crafted for excellence.</h1></div>
        <div class="categories">
            <div class="category-headings"> 
                <h2>Shop by category</h2>
            </div>

            <div class="category-icons">
                <div class="category-item">
                    <p>Laptops</p>
                    <span class="laptop-icon">
                        <img src="../images/laptop icon.png" alt="laptop">
                    </span>
                    <div class="subcategories">
                        <div class="subcategory">
                            <a href="products/subcategories.php?subcategory=Macbooks">
                                <p>Apple</p>
                                <span class="apple-icon">
                                    <img src="../images/apple logo.png" alt="apple">
                                </span>
                            </a>
                        </div>
                        <div class="subcategory">
                            <a href="products/subcategories.php?subcategory=hp">
                                <p>HP</p>
                                <span class="hp-logo hp-icon">
                                    <img src="../images/hp logo.png" alt="">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="category-item">
                    <p>Phones</p>
                    <span class="laptop-icon">
                        <img src="../images/phone icon.png" alt="phone">
                    </span>
                    <div class="subcategories">
                        <div class="subcategory">
                            <a href="products/subcategories.php?subcategory=iPhones">
                                <p>Apple</p>
                                <span class="apple-icon">
                                    <img src="../images/apple logo.png" alt="">
                                </span>
                            </a>
                        </div>
                        <div class="subcategory">
                            <a href="products/subcategories.php?subcategory=samsung">
                                <p>Samsung</p>
                                <span class="samsung-logo samsung-icon">
                                <img src="../images/samsung icon.png" alt="">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>