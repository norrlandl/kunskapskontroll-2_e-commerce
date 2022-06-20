<!-- Kod ska in i product.php -->


<?php
require('../../src/config.php');

?>


</head>
<body>
<div class="container">
<?php include('cart.php') ?>



<form action="add-cart-item.php" method="POST">
  <input type="hidden" name="productId" value="<?=$product['id']?>">
  <input type="number" name="quantity" value="1" min="0">
  <input type="submit" name="addToCart" value="KÖP">

</form>






