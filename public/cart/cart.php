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
      <span class="total-amount-header">(<?= $cartTotalItems  ?>)</span>
    </i>

    <span><?php $counter = 0 ?></span>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

      <h5 class="total-amount-products">Varukorg (<?= $cartTotalItems  ?>)</h5>

      <table class="table table-hover table-cart">

        <thead>
          <tr>
            <th scope="col">Produkt</th>
            <th scope="col"></th>
            <th scope="col">Antal</th>
            <th scope="col">Summa</th>
            <th scope="col"></th>
          </tr>
        </thead>

        <tbody class="cart-body">

          <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) :

          ?>


            <tr class="cart-item-<?= $cartId ?>">
              <td>
                <div class="cart-img">
                  <img src="/kunskapskontroll-2_e-commerce/public/img/<?= $cartItem['img_url'] ?>">
                </div>
              </td>
              <td>
                <p class="cart-title"><?= $cartItem['title'] ?></p>

                <p><?= $cartItem['price'] ?> kr</p>

              </td>
              <td>
                <!-- UPDATE -->
                <form id="update-cart-form" class="updateCart">
                  <input type="hidden" name="cartId" value="<?= $cartId ?>">
                  <input type="hidden" name="price" value="<?= $cartItem['price'] ?>">

                  <input type="number" class="total-amount-<?= $cartId ?> update-quantity" name="quantity" value="<?= $cartItem['quantity'] ?>" min="0">
                  <!-- <div class="input-group mb-3">
                    <select class="total-amount-<?= $cartId ?> update-quantity custom-select select-checkout" id="quantity" name="quantity" value="<?= $cartItem['quantity'] ?>">
                      <?php

                      for ($i = 1; $i <= $cartItem['stock']; $i++) {
                        echo "<option value=" . $i . ">" . $i . "</option>";
                      }
                      ?>
                    </select>
                  </div> -->

                </form>
              </td>
              <td>
                <p class="total-price-<?= $cartId ?>"><?= $cartItem['price'] * $cartItem['quantity'] ?> kr </p>
              </td>
              <td>
                <!-- DELETE -->
                <form class="delete-button">
                  <input type="hidden" name="cartId" value="<?= $cartId ?>">
                  <button type="submit" class="hide" value=""><i class='fa-solid fa-trash-can'></i>
                  </button>


                </form>
              </td>
            </tr>
        </tbody>

      <?php endforeach; ?>

      <tfoot>
        <tr>
          <td colspan="5"></td>
        </tr>
        <tr>

          <td colspan="5">
            <b>
              <p class="total-price">Att betala: <?= $cartTotalSum ?> kr</p>
            </b>
          </td>
        </tr>
        <tr>
          <td colspan="5">
            <form action="/kunskapskontroll-2_e-commerce/public/cart/checkout.php" method="">
              <button class="btn btn-primary btn-block mb-4">KASSAN</button>
            </form>
          </td>
        </tr>
      </tfoot>
      </table>
    </div>
  </div>
</div>