<!--  cart.php är inkluderat i checkout.php

Så dessa variablar fungerar även i checkout.php:
$cartTotalSum 
$cartTotalItems 

-->


<?php
require('../../src/config.php');

$cartTotalSum = 0;
$cartTotalItems = 0;

foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
  $cartTotalItems += $cartItem['quantity'];
}

?>

<?php include('../layout/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="info">
      <p><b>KASSAN</b></p>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque feugiat accumsan vel, est vitae. Hac elit nibh dui in neque eget arcu. Urna aliquet posuere at senectus erat. Pretium sem tincidunt.
      </p>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <td>
        </td>
        <td>
        </td>
        <td>
          <h5>Pris</h5>
        </td>
        <td>
          <h5>Antal</h5>
        </td>
        <td>
          <h5>Total</h5>
        </td>
        <td>
        </td>
      </tr>
    </thead>
    <tbody>

      <?php $counter = 0 ?>

      <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) :

        $counter++;
        $divclass = "";
        if ($counter % 2 == 0) {
          $divclass = "cart-background";
        }

      ?>
        <tr class="<?php echo $divclass; ?>">

          <td>
            <div class="cart-img">
              <img src="../img/<?= $cartItem['img_url'] ?>">
            </div>
          </td>
          <td>
            <p><?= $cartItem['title'] ?></p>
            <!-- <p><?= $cartItem['description'] ?></p> -->

          </td>
          <td>
            <p><?= $cartItem['price'] ?>kr</p>
          </td>
          <td>
            <!-- <p><?= $cartItem['quantity'] ?></p> -->
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
              <button type="submit" class="DÖLJS_MED_CSS" value=""> TA BORT
              </button>
            </form>
          </td>

        </tr>
    </tbody>

  <?php endforeach; ?>

  <tfoot>
    <tr>
      <td>
        <p>Totalt antal items: <?= $cartTotalItems  ?></p>
      </td>
      <td>
        <p>Totalsumman: <?= $cartTotalSum ?></p>
      </td>
      <td></td>
      <td>

      </td>
      <td>

      </td>
    </tr>
  </tfoot>
  </table>




  <h4>Fakturaadress</h4>

  <form action="create-order.php" method="POST">

    <input type="hidden" name="cartTotalSum" value="<?= $cartTotalSum ?>">

    <label for="input">Förnamn:</label> <br>
    <input type="text" class="text" name="first_name" id="cart_first_name"> <br>

    <label for="input">Efternamn:</label> <br>
    <input type="text" class="text" name="last_name" id="cart_last_name"> <br>

    <label for="input">Adress:</label> <br>
    <input type="text" class="text" name="street" id="cart_street"> <br>

    <label for="input">Postkod:</label> <br>
    <input type="text" class="text" name="postal_code" id="cart_postal_code"> <br>

    <label for="input">Stad:</label> <br>
    <input type="text" class="text" name="city" id="cart_city"> <br>

    <label for="input">Land:</label> <br>
    <input type="text" class="text" name="country" id="cart_country"> <br>

    <label for="input">Telefon:</label> <br>
    <input type="text" class="text" name="phone" id="cart_phone"> <br>

    <label for="input">E-post:</label> <br>
    <input type="text" class="text" name="email" id="cart_email"> <br>

    <label for="input">Lösenord:</label> <br>
    <input type="password" class="text" name="password" id="cart_passord"> <br>

    <button type="submit" name="createOrderBtn">Genomför köp</button>

  </form>
</div>

<!-- skickar formuläret när man ändra kvantitet -->
<script type="text/javascript">
$('.update-cart-form input[name="quantity"]').on('change', function(){
    $(this).parent().submit();
});
</script>
