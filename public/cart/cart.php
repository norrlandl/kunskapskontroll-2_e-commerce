<!-- Är importerad i products.php & checkout.php så behöver ej config -->

<?php


// echo "<pre>";
// print_r($_SESSION['cartItems'])   
// echo "<pre>";

if (!isset($_SESSION['cartItems'])) {
  $_SESSION['cartItems'] = [];
}

// räkna ut totalsumman

$cartTotalSum = 0;
$cartTotalItems = 0;

foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
  $cartTotalItems += $cartItem['quantity'];
}


?>


<?php foreach($_SESSION['cartItems'] as $cartId => $cartItem): ?>

<div>
  <img src="img/<?=$cartItem['img_url']?>">
  <p><?=$cartItem['title']?></p>
  <p><?=$cartItem['price']?></p>
  <p><?=$cartItem['quantity']?></p>
  <p>otalsumman: <?=$cartTotalSum ?></p>
  <p>Totalt antal items: <?=$cartTotalItems  ?></p>
</div>


<?php endforeach; ?>