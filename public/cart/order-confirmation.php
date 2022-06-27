<?php
require('../../src/config.php');

if (empty($_SESSION['cartItems'])) {
  header('Location: checkout.php');
}

$cartItems = $_SESSION['cartItems'];
$totalSum = 0;
foreach ($cartItems as $cartId => $cartItem) {
  $totalSum += $cartItem['price'] * $cartItem['quantity'];
}
unset($_SESSION['cartItems'])


?>


<?php include('../layout/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="info">
      <p><b>Din order har genomförts!</b></p>

      <p>För att se orderdetaljer gå till <a href="/kunskapskontroll-2_e-commerce/public/user/user.php">mina sidor</a>.
      </p>
    </div>
  </div>


  <div class="container-small">
    <h4>Order #3</h4>
    <table class="table table-checkout">

      <thead>
        <tr>
          <th scope="col" width="120"></th>
          <th scope="col" width="300" colspan="2">Poster</th>
          <!-- <th scope="col"></th> -->
          <th scope="col">Antal</th>
          <th scope="col">Summa</th>
          <th scope="col"></th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($cartItems as $item) : ?>

          <tr>
            <td>
              <div class="confirmation-img">
                <img src="/kunskapskontroll-2_e-commerce/public/img/<?= $item['img_url'] ?>">
              </div>
            </td>
            <th scope="row" colspan="2">
              <p><?= $item['title'] ?></p>
            </th>
            <!-- <td>
              <p><?= $item['price'] ?></p>
            </td> -->
            <td>
              <p><?= $item['quantity'] ?></p>
            </td>
            <td>
              <p><?= $item['price'] * $item['quantity'] ?>kr </p>
            </td>
            <td>
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
          <!-- <p>Antal: <?= $cartTotalItems  ?></p> -->
        </td>
        <td colspan="2">
          <p>Totalsumma: <?= $totalSum ?>kr</p>
        </td>
      </tr>
    </tfoot>
    </table>

    <form action="/kunskapskontroll-2_e-commerce/public/index.php">
      <input type="submit" class="btn btn-primary" value="Till startsidan" />
    </form>

  </div>
</div>

<?php include('../layout/footer.php'); ?>