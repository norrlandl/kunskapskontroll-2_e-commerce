<?php
require('../../src/config.php');

$cartTotalSum = 0;
$cartTotalItems = 0;

foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
  $cartTotalItems += $cartItem['quantity'];
}

$message = "";
if (isset($_SESSION["errorMessages"])) {
  $message = $_SESSION["errorMessages"];
  unset($_SESSION["errorMessages"]);
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

        <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) :

          $string = preg_replace('/\s+?(\S+)?$/', '', substr($cartItem['description'], 0, 50));

        ?>

          <tr class="cart-item-<?= $cartId ?>">
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
              <p><?= $cartItem['price'] ?> kr</p>
            </td>
            <td>
              <!-- UPDATE -->
              <form class="updateCart" id="update-cart-form">
                <input type="hidden" name="cartId" value="<?= $cartId ?>">
                <input type="hidden" name="price" value="<?= $cartItem['price'] ?>">



                <input type="number" class="total-amount-<?= $cartId ?> update-quantity" name="quantity" value="<?= $cartItem['quantity'] ?>" min="0">

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
        <td></td>
        <td></td>
        <td></td>
        <td>
          <p class="total-amount"> <b>Antal</b>: <?= $cartTotalItems  ?> st</p>
        </td>
        <td colspan="2">
          <p class="total-price"><b>Att betala</b>: <?= $cartTotalSum ?> kr</p>
        </td>
      </tr>
    </tfoot>

    </table>
  </div>

  <div class="container-small">
    <h4>Fakturaadress</h4>

    <?php
    if (isset($_SESSION['email'])) {
      $user = $userDbHandler->fetchUserByEmail($_SESSION['email']);
      // debug($user);
    }
    ?>

    <?= $message ?>

    <form action="create-order.php" method="POST">

      <input type="hidden" name="cartTotalSum" value="<?= $cartTotalSum ?>">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_first_name">Förnamn</label>
          <input type="text" class="form-control" name="first_name" id="cart_first_name" value="<?php if (isset($_SESSION['email'])) {
                                                                                                  echo htmlentities($user["first_name"]);
                                                                                                } ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_last_name">Efternamn</label>
          <input type="text" class="form-control" name="last_name" id="cart_last_name" value="<?php if (isset($_SESSION['email'])) {
                                                                                                echo htmlentities($user["last_name"]);
                                                                                              } ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="cart_street">Adress</label>
        <input type="text" class="form-control" name="street" id="cart_street" value="<?php if (isset($_SESSION['email'])) {
                                                                                        echo htmlentities($user["street"]);
                                                                                      } ?>">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_city">Stad</label>
          <input type="text" class="form-control" name="city" id="cart_city" value="<?php if (isset($_SESSION['email'])) {
                                                                                      echo htmlentities($user["city"]);
                                                                                    } ?>">
        </div>
        <div class="form-group col-md-2">
          <label for="cart_postal_code">Zip</label>
          <input type="text" class="form-control" name="postal_code" id="cart_postal_code" value="<?php if (isset($_SESSION['email'])) {
                                                                                                    echo htmlentities($user["postal_code"]);
                                                                                                  } ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="cart_country">Land</label>
          <select id="cart_country" class="form-control" name="country" value="<?php if (isset($_SESSION['email'])) {
                                                                                  echo htmlentities($user["country"]);
                                                                                } ?>">
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
          <input type="text" class="form-control" name="email" id="cart_email" value="<?php if (isset($_SESSION['email'])) {
                                                                                        echo htmlentities($user["email"]);
                                                                                      } ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_phone">Telefon</label>
          <input type="text" class="form-control" name="phone" id="cart_phone" value="<?php if (isset($_SESSION['email'])) {
                                                                                        echo htmlentities($user["phone"]);
                                                                                      } ?>">
        </div>
      </div>

      <?php if (!isset($_SESSION['email'])) { ?>
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

      <?php } ?>


      <?php if (!isset($_SESSION['email'])) { ?>
        <p><i>Ett nytt konto skapas vid genomförande av köp</i></p>
      <?php } ?>
      <div class="form-group">
        <div class="form-check">
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="checkbox" id="gridCheck">
          <label class="form-check-label" for="gridCheck">
            Bekräfta villkoren
          </label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary" name="createOrderBtn">Genomför köp</button>
    </form>
  </div>
</div>
<?php include('../layout/footer.php'); ?>
<script src="/kunskapskontroll-2_e-commerce/public/js/cart.js"></script>