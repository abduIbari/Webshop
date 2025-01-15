<?php
session_start();
require "db_connection.php";
$user_role = "customer";

$stmt = $pdo->prepare("SELECT * FROM users WHERE role = :user_role");
$stmt->bindParam(':user_role', $user_role);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
    <script src="../../js/searchUsers.js" defer></script>

</head>
<body>
<header>
    
    <nav>
        <a href="adminDashboard.php" class="tomorrow-extralight">
            MBW
        </a>
        <div class="nav-icons">
            <a href="customer.php">
                <span class="material-symbols-outlined">person</span>
            </a>
            <a href="auth/logout.php">
                <span class="material-symbols-outlined">logout</span>
            </a>
            <i class="material-symbols-outlined" id="toggleDark">contrast</i>
        </div>
    </nav>
    <div class="search-container">
    <div class="search-field">
    <input type="text" id="userSearchInput" class="search-input tomorrow-extralight" placeholder="Search users..." required>
        <button class="auth-button">
            <span class="material-symbols-outlined">search</span>
        </button>
    </div>
</div>
</header>
        <main class="checkout-page">
    <h1>Admin Dashboard - Users</h1>
    
    <?php if (!empty($users)): ?>
        <table class="orders-table">
            <thead>
                <tr>
                  <th>User ID</th>
                    <th>Username</th>
                    <th>Login Status</th>
                    <th>Blocked</th>
                    <th>Change Blocked Status</th>
                </tr>
            </thead>
            <tbody id="users-table-body">
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['userID']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['active'] == 1 ?  "Logged in" : "Logged out"; ?></td>
                        <td id="td-blocked-status-<?= $user['userID']; ?>"><?= $user['blocked'] == 1 ?  "Blocked" : "Unblocked"; ?></td>
                        <td>
                          <select name="blockedStatus" id="blockedStatus" class="auth-button" data-userID="<?= $user['userID']; ?>">
                              <option value="Blocked" <?= $user['blocked'] == 1 ? 'selected' : ''; ?>>Blocked</option>
                              <option value="Unblocked" <?= $user['blocked'] == 0 ? 'selected' : ''; ?>>Unblocked</option>
                          </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
    </main>
</body>
</html>
