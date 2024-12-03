<?php
$json_data = file_get_contents("../products.json");
$products = json_decode($json_data, true);
$query_pid = $_GET["pid"];

if(isset($query_pid)) {
    if(empty($query_pid)) {
        echo "No value fo the parameter!";
    }
}
else {
    echo "Parameter is missing!";
}


$product = null;
foreach($products["Products"] as $item){
    if($item["pid"] == $query_pid){
        $product = $item; 
        break;
    }
}

if (!$product) {
    echo "<h1>Product not found</h1>";
    exit;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product["name"]; ?></title>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../mystyle.css">
    <script src="../task2script.js" defer></script>

    <!-- Task1 -->
    <!-- <link rel="stylesheet" href="../firstyle.css"> -->

</head>

<body>

    <nav>
        <a href="../index.php" class="tomorrow-extralight">
            MBW
        </a>
        <div class="nav-icons">
            <a href="../customer.php">
                <span class="material-symbols-outlined">person</span>
            </a>
            <a href="../auth/login.php">
                <span class="material-symbols-outlined">login</span>
            </a>
            <i class="material-symbols-outlined" id="toggleDark">contrast</i>
        </div>
    </nav>

    <main>
        <div class="product-details-container">
            <div>
                <img class="product-image" src="<?php echo $product["imagePath"]; ?>" alt=<?php echo $product["name"]; ?>>
            </div>

            <div class="product-info">
                <h1><?php echo $product["name"]; ?></h1>
                <table>
                    <tr>
                        <td style="width: 150px;"><strong>Brand</strong></td>
                        <td><?php echo $product["tableDescription"]["Brand"]; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><strong>Model name</strong></td>
                        <td><?php echo $product["tableDescription"]["Model name"]; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><strong>Screen Size</strong></td>
                        <td><?php echo $product["tableDescription"]["Screen Size"]; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><strong>Colour</strong></td>
                        <td><?php echo $product["tableDescription"]["Colour"]; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><strong>Storage</strong></td>
                        <td><?php echo $product["tableDescription"]["Storage"]; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><strong>RAM</strong></td>
                        <td><?php echo $product["tableDescription"]["RAM"]; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;"><strong>Chip</strong></td>
                        <td><?php echo $product["tableDescription"]["Chip"]; ?></td>
                    </tr>
                </table>
                <button>Add to cart</button>
            </div>
        </div>

        <div class="product-description">
        <?php if (isset($product["productDescription"]) && is_array($product["productDescription"])): ?>
            <?php foreach($product["productDescription"] as $description): ?>
                <p><?php echo $description;?></p>    
                <?php endforeach; ?>
                <?php endif; ?>
        </div>
    </main>
</body>

</html>