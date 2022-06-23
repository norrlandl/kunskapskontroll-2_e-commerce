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

      <h5>Produkter (<?= $cartTotalItems  ?>)</h5>

      <table class="table table-hover">

        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col">Antal</th>
            <th scope="col">Summa</th>
            <th scope="col"></th>
          </tr>
        </thead>

        <tbody>

          <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) :
            $string = preg_replace('/\s+?(\S+)?$/', '', substr($cartItem['description'], 0, 20));

          ?>


            <tr>
              <td>
                <div class="checkout-img">
                  <img src="../img/<?= $cartItem['img_url'] ?>">
                </div>
              </td>
              <td>
                <p class="cart-title"><?= $cartItem['title'] ?></p>
                <p><?= htmlentities($string) ?>.</p>
                <b>
                  <p><?= $cartItem['price'] ?>kr</p>
                </b>
              </td>
              <td>
                <!-- UPDATE -->
                <form id="update-cart-form" action="update-cart-item.php" method="POST">
                  <input type="hidden" name="cartId" value="<?= $cartId ?>">
                  <input type="number" class="update-quantity" name="quantity" value="<?= $cartItem['quantity'] ?>" min="0">
                </form>
              </td>
              <td>
                <p><?= $cartItem['price'] * $cartItem['quantity'] ?>kr </p>
              </td>
              <td>
                <!-- DELETE -->
                <form action="delete-cart-item.php" method="POST">
                  <input type="hidden" name="cartId" value="<?= $cartId ?>">
                  <button type="submit" class="btn btn-outline-danger" value="">Ta bort
                  </button>


                </form>
              </td>
            </tr>
        </tbody>

      <?php endforeach; ?>

      <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <p>Antal: <?= $cartTotalItems  ?></p>
          </td>
          <td colspan="2">
            <b>
              <p>Att betala: <?= $cartTotalSum ?>kr</p>
            </b>
          </td>
          <td></td>
        </tr>
        <tr>
          <td colspan="5">
            <form action="cart/checkout.php" method="">
              <button class="btn btn-primary btn-block mb-4">KASSAN</button>
            </form>
          </td>
        </tr>
      </tfoot>
      </table>
    </div>
  </div>
</div>