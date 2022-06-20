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

<h4>Fakturaadress</h4>

<form action="create-order.php" method="POST">

  <input type="hidden" name="cartTotalSum" value="<?=$cartTotalSum ?>">

  <label for="input">Förnamn:</label> <br>
  <input type="text" class="text" name="first_name" id="cart_first_name">   <br>

  <label for="input">Efternamn:</label> <br>
  <input type="text" class="text" name="last_name" id="cart_last_name">  <br>
  
  <label for="input">Adress:</label> <br>
  <input type="text" class="text" name="street" id="cart_street">  <br>
  
  <label for="input">Postkod:</label> <br>
  <input type="text" class="text" name="postal_code" id="cart_postal_code">  <br>
  
  <label for="input">Stad:</label> <br>
  <input type="text" class="text" name="city" id="cart_city">  <br>
  
  <label for="input">Land:</label> <br>
  <input type="text" class="text" name="country" id="cart_country">  <br>

  <label for="input">Telefon:</label> <br>
  <input type="text" class="text" name="phone" id="cart_phone">  <br>
    
  <label for="input">E-post:</label> <br>
  <input type="text" class="text" name="email" id="cart_email">  <br>

  <label for="input">Lösenord:</label> <br>
  <input type="password" class="text" name="password" id="cart_passord">  <br>

  <button type="submit" name="createOrderBtn">Genomför köp</button>

</form>


<!-- Byt ut jQuery // skickar formuläret när man ändra kvantiteten -->
<script type="text/javascript">
$('.update-cart-form input[name="quantity"]').on('change', function(){
    $(this.).parent().submit();
});
</script>