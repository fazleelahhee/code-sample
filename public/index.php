<?php
require_once "../vendor/autoload.php";
use Fazle\CodingExample\App;
use Fazle\CodingExample\Model\Product;

$basket = [
    [
        "sku" => "A",
        "qty" => 3
    ],
    [
        "sku" => "B",
        "qty" => 2
    ],
    [
        "sku" => "C",
        "qty" => 5
    ],
    [
        "sku" => "D",
        "qty" => 1
    ],
    [
        "sku" => "E",
        "qty" => 1
    ],
];
$productConfig = require_once __DIR__ . "/../config.php";

//initialse products
Product::init($productConfig);

$app = new App();
$app->addBasket($basket);
$app->buildCart();
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="md:container lg:container mx-auto mt-8">
    <h1 class="text-3xl font-bold">
        Shopping Cart
    </h1>

    <div class="grid grid-cols-6 gap-4 mt-8">
        <div class="text-xl font-bold text-center">Product Name</div>
        <div class="text-xl font-bold text-center">SKU</div>
        <div class="text-xl font-bold text-center">QTY</div>
        <div class="text-xl font-bold text-center">Unit Price</div>
        <div class="text-xl font-bold text-center">Line Total</div>
        <div class="text-xl font-bold text-center">Special Offer</div>

      <?php foreach($app->cart()->getCartItems() as $cartItem): ?>
        <div class="text-center"><?php echo $cartItem->product()->name(); ?></div>
        <div class="text-center"><?php echo $cartItem->product()->sku(); ?></div>
        <div class="text-center"><?php echo $cartItem->qty(); ?></div>
        <div class="text-center"><?php echo $cartItem->product()->unitPrice(); ?></div>
        <div class="text-center"><?php echo $cartItem->getLineTotal(); ?></div>
        <div class="text-center"><?php echo $cartItem->getSpecialPrice($app->cart()->getCartItems()); ?></div>
      <?php endforeach; ?>
      
        <div class="text-xl font-bold text-center"></div>
        <div class="text-xl font-bold text-center"></div>
        <div class="text-xl font-bold text-center"></div>
        <div class="text-xl font-bold text-center">Total</div>
        <div class="text-xl font-bold text-center"><?php echo $app->cart()->getSubTotal(); ?></div>
        <div class="text-xl font-bold text-center"><?php echo $app->cart()->getSpecialOffer(); ?></div>
      
    </div>
</body>
</html>