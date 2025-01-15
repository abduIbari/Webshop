<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styling/mystyle.css">
    <script src="../js/formValidation.js" defer></script>
    <script src="../js/darkMode.js" defer></script>
    <script src="../js/cart.js" defer></script>
    
    <!-- Task1 -->
    <!-- <link rel="stylesheet" href="firstyle.css"> -->
    
</head>
<body>
        <nav>
            <a href="index.php" class="tomorrow-extralight">
                MBW
            </a>
            <div class="nav-icons">
                <a href="about.php">About us</a>
                <a href="shoppingCart.php" id="cart-link">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span id="cart-count">0</span>
                </a>
                <i class="material-symbols-outlined" id="toggleDark">contrast</i>
            </div>
        </nav>

    
    <main>
        <div class="box">
            <h2>User Information</h2>
            <form action="../apis/customer_apis/updateUser.php" method="POST" >
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $_SESSION["username"];?>" required>
                </div>
                <div>
                    <label for="changeUsername">Change Username:</label>
                    <input type="text" id="changeUsername" name="changeUsername">
                </div>
                <div>
                    <label for="changePassword">Change Password:</label>
                    <input type="password" id="changePassword" name="changePassword">
                </div>
                <div class="buttons-foot">
                    <button type="submit" class="auth-button">Update Information</button>
                </form>
                <form action="../apis/auth_apis/processLogout.php" method="POST">
                    <button type="submit" class="auth-button">Logout</button>
                </div>
            </form>
        </div>
    </main>
    </body>
</html>
