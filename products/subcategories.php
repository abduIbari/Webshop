<?php
$json_data = file_get_contents("../products.json");
$products = json_decode($json_data, true);

$query_subcategory = $_GET["subcategory"];

if(isset($query_subcategory)) {
  if(empty($query_subcategory)) {
      echo "No value fo the parameter!";
      exit;
  }
}
else {
  echo "Parameter is missing!";
}


$filtered_products = [];
foreach($products["Products"] as $item){
  if($item["subcategory"] == $query_subcategory){
      $filtered_products[] = $item; 
  }
}

if (!$filtered_products) {
  echo "<h1>Products not found</h1>";
  exit;
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $filtered_products[0]["subcategory"]; ?></title>
    <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@100..900&family=Tomorrow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap" />
    <link rel="stylesheet" href="../mystyle.css">
    <script src="../taxCalculation.js" defer></script>
    <script src="../changeCurrency.js" defer></script>
    <script src="../collectionList.js" defer></script>
    <script src="../task2script.js" defer></script>

    <!-- Task1 -->
    <!-- <link rel="stylesheet" href="../firstyle.css"> -->

</head>
<body class="products-page">
    <header>
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
    </header>
     
    <main>
      <div class="all-products">
      <?php foreach ($filtered_products as $product): ?>
        <div class="product">
            <a href="../product details/product.php?pid=<?php echo $product['pid'];?>">
            <img src="<?php echo $product['imagePath'];?>" width="200", height="auto">
            <div class="info">
                <span class="product-name"><?php echo $product['tableDescription']['Model name'];?></span>
                <p id="<?php echo $product['priceId'];?>">Price: €<?php echo $product['price'];?></p>
                <p id="<?php echo $product['taxPriceId'];?>" class="taxPara"></p>
            </div> 
        </a>
        <button id="<?php echo $product['collectionButtonId'];?>" class="auth-button">Add to collection</button>
        </div>
        <?php endforeach; ?>
        </div>

        
    </div>
    <div class="currency-container">
        <button id="currencyBtn" class="auth-button">Change Currency?</button>
        <div id="currencyDropdown" class="dropdown-content">
            <a data-currency="EUR" data-symbol="€">EUR</a>
            <a data-currency="USD" data-symbol="$">USD</a>
            <a data-currency="GBP" data-symbol="£">GBP</a>
        </div>
    </div>

    
</main>
    <div class="collection-list">
        <h2>Your Collection</h2>
        <ul id="collectionItems">
            <!-- Items will be dynamically added here -->
        </ul>
    </div>
</body>
</html>