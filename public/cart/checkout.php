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

$message = "";

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


  <div class="container-small">
    <h4>Din varukorg</h4>
    <table class="table table-hover table-checkout">

      <thead>
        <tr>
          <th scope="col" width="140"></th>
          <th scope="col" width="300"></th>
          <th scope="col">Pris</th>
          <th scope="col">Antal</th>
          <th scope="col">Summa</th>
          <th scope="col"></th>
        </tr>
      </thead>

      <tbody>

        <!-- <?php $counter = 0 ?> -->

        <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) :

          // $counter++;
          // $divclass = "";
          // if ($counter % 2 == 0) {
          //   $divclass = "cart-background";
          // }

          $string = preg_replace('/\s+?(\S+)?$/', '', substr($cartItem['description'], 0, 50));


        ?>

          <tr>
            <!-- <tr class="<?php echo $divclass; ?>"> -->
            <td>
              <div class="checkout-img">
                <img src="../img/<?= $cartItem['img_url'] ?>">
              </div>
            </td>
            <td>
              <p class="cart-title"><?= $cartItem['title'] ?></p>
              <p><?= htmlentities($string) ?>.</p>
            </td>
            <td>
              <p><?= $cartItem['price'] ?>kr</p>
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
        <td>
          <p>Antal: <?= $cartTotalItems  ?></p>
        </td>
        <td colspan="2">
          <p>Totalpris: <?= $cartTotalSum ?>kr</p>
        </td>
      </tr>
    </tfoot>

    </table>
  </div>

  <div class="container-small">
    <h4>Fakturaadress</h4>

    <?= $message ?>

    <form action="create-order.php" method="POST">

      <input type="hidden" name="cartTotalSum" value="<?= $cartTotalSum ?>">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_first_name">Förnamn</label>
          <input type="text" class="form-control" name="first_name" id="cart_first_name">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_last_name">Efternamn</label>
          <input type="text" class="form-control" name="last_name" id="cart_last_name">
        </div>
      </div>

      <div class="form-group">
        <label for="cart_street">Adress</label>
        <input type="text" class="form-control" name="street" id="cart_street">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_city">Stad</label>
          <input type="text" class="form-control" name="city" id="cart_city">
        </div>
        <div class="form-group col-md-2">
          <label for="cart_postal_code">Zip</label>
          <input type="text" class="form-control" name="postal_code" id="cart_postal_code">
        </div>
        <div class="form-group col-md-4">
          <label for="cart_country">Land</label>
          <select id="cart_country" class="form-control" name="country">
            <option selected>Sverige</option>
            <option>Norge</option>
            <option>Finland</option>
            <option>Danmark</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_email">E-post</label>
          <input type="text" class="form-control" name="email" id="cart_email">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_phone">Telefon</label>
          <input type="text" class="form-control" name="phone" id="cart_phone">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_passord">Lösenord</label>
          <input type="password" class="form-control" name="password" id="cart_passord">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_confirm">Bekräfta lösenord</label>
          <input type="password" class="form-control" name="confirm" id="cart_confirm">
        </div>
      </div>

      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="gridCheck">
          <label class="form-check-label" for="gridCheck">
            Bekräfta köpvillkoren
          </label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="createOrderBtn">Genomför köp</button>
    </form>
  </div>
</div>

<?php include('../layout/footer.php'); ?>


<!-- skickar formuläret när man ändra kvantitet -->
<!-- <script type="text/javascript">
  const quantity = document.querySelector('#update-cart-form input[name="quantity"]');

  quantity.addEventListener('change', function(e) {
    e.target.parentNode().submit();
  });
</script> -->

<script type="text/javascript">
  $('#update-cart-form input[name="quantity"]').on('change', function() {
    $(this).parent().submit();
  });
</script>