<!-- Ska importerad i header.php & checkout.php så behöver ej config -->

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




<div class="cart">
  <div class="dropdown">
    <i class="fa fa-shopping-bag shopping-icon" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      (<?= $cartTotalItems  ?>)
    </i>

    <span><?php $counter = 0 ?></span>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
      <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) :

        $counter++;
        $divclass = "";
        if ($counter % 2 == 0) {
          $divclass = "cart-background";
        }

      ?>

        <div class="cart-grid-container <?php echo $divclass; ?>">
          <div class="cart-img">
            <img src="/kunskapskontroll-2_e-commerce/public/img/<?= $cartItem['img_url'] ?>">
          </div>
          <div class="cart-title">
            <p><?= $cartItem['title'] ?></p>
          </div>
          <div class="cart-price">
            <p><?= $cartItem['price'] ?> kr</p>
          </div>
          <div class="cart-quantity">
            <p><?= $cartItem['quantity'] ?> st
              <?= $cartItem['price'] * $cartItem['quantity'] ?> kr </p>

          </div>
        </div>

      <?php endforeach; ?>
      <div class="cart-total">
        <p>Totalsumman: <?= $cartTotalSum ?> kr</p>
        <p>Totalt antal posters: <?= $cartTotalItems  ?> st</p>
      </div>
      <form action="cart/checkout.php" method="">
        <button class="btn btn-primary btn-block mb-4">KASSAN</button>
      </form>


    </div>
  </div>
</div>