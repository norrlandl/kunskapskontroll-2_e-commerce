<?php
require('../../src/config.php');

if (empty($_SESSION['cartItems'])) {
  header('Location: checkout.php')
  exit;
}

$cartItems = $_SESSION['cartItems'];
$totalSum = 0;
foreach ($cartItems as $cartId => $cartItem) {
  $totalSum += $cartItem['price'] * $cartItem['quantity'];
}
unset($_SESSION['cartItems'])


?>


</head>
<body>
<div class="container">
<?php include('cart.php') ?>


<h4>Confirm</h4>


<?php foreach ($cartItems as $item): ?>

  <img src="img/<?=$item['img_url']?>">
  <p><?=$item['title']?></p>
  <p><?=$item['description']?></p>
  <p><?=$item['quantity']?></p>
  <p><?=$item['price']?></p>
  <p>Totalsumman: <?=$totalSum ?></p>


<?php endforeach; ?>