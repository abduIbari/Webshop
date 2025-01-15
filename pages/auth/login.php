<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Red+Hat+Text:ital,wght@0,300..700;1,300..700&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../../styling/mystyle.css">
    <script src="../../js/formValidation.js" defer></script>
    <script src="../../js/darkMode.js" defer></script>

    <!-- Task1 -->
    <!-- <link rel="stylesheet" href="../firstyle.css"> -->

</head>
<body>
    <nav>
        <a href="../index.php" class="tomorrow-extralight">
            MBW
        </a>
        
        <i class="material-symbols-outlined" id="toggleDark">contrast</i>
    </nav>
    <main>
        <div class="box">
            <h2>Log in</h2>
            <form method="post" action="../../apis/auth_apis/checkLoginStatus.php">
                <!-- Username Field -->
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <!-- Password Field -->
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <!-- Buttons -->
                <div class="buttons-foot">
                    <a href="registration.php">
                        <button type="button" class="auth-button">Register</button>
                    </a>
                    <button type="submit" class="auth-button">Sign in</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
