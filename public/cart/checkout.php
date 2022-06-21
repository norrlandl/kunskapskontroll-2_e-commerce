<!--  cart.php är inkluderat i checkout.php

Så dessa variablar fungerar även i checkout.php:
$cartTotalSum 
$cartTotalItems 

-->


<?php
require('../../src/config.php');

?>

</head>
<body>
<div class="container">
<?php include('cart.php') ?>



<?php foreach($_SESSION['cartItems'] as $cartId => $cartItem): ?>

<table>


  <img src="img/<?=$cartItem['img_url']?>">
  <p><?=$cartItem['title']?></p>
  <p><?=$cartItem['description']?></p>
  <p><?=$cartItem['price']?></p>
  <p><?=$cartItem['quantity']?></p>
  <p>Totalt antal items: <?=$cartTotalItems  ?></p>

<!-- DELETE -->
<form action="delete-cart-item.php" method="POST">
  <input type="hidden" name="cartId" value="<?=$cartId?>">
  <button type="submit" class="DOLD GENOM CSS" value=""> SVG_FIL SOPTUNNA
  </button>
</form>

<!-- UPDATE -->
<form class="update-cart-form" action="update-cart-item.php" method="POST">
  <input type="hidden" name="cartId" value="<?=$cartId?>">
  <input type="number" name="quantity" value="<?=$cartItem['quantity']?>" min="0">
  <button type="submit" name="quantity" value="1" min="0">
  </button>
</form>

<p>Totalsumman: <?=$cartTotalSum ?></p>

</table>


<?php endforeach; ?>


<!-- Byt ut jQuery // skickar formuläret när man ändra kvantiteten -->
<script type="text/javascript">
$('.update-cart-form input[name="quantity"]').on('change', function(){
    $(this).parent().submit();
});
</script>