<?php
require('../../src/config.php');
$pageTitle = "Användare";
$pageId    = "user-order-details";


if (!isset($_SESSION['email'])) {
  header("Location: ./user-login.php?mustLogin");
}

$orderDetails = "";
$newOrderDate = "";

$orderDetails = $orderDbHandler->getOrder($_GET['id'], "order_items");

$createOrderDate = new DateTime($orderDetails['0']['create_date']);
$newOrderDate = $createOrderDate->format('Y-m-d');

// debug($orderDetails);


?>

<?php include('../layout/header.php'); ?>

<?php ?>



<div class="container">


  <div class="container-small">
    <div class="row">
      <div class="info">
        <p><b>Tidigare ordrar
          </b></p>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque.
        </p>
      </div>
    </div>
    <div class="order-details-title">
      <h4>Ordernummer <i class="order-date">#<?= $orderDetails['0']['id'] ?></i></h4>
      <h4>Beställningsdatum <i class="order-date"> <?= $newOrderDate ?></i></h4>
    </div>


    <table class="table table-order table-order-details">


      <thead>
        <tr>
          <th scope="col">Poster</th>
          <th scope="col">Antal</th>
          <th scope="col">Pris</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($orderDetails as $details) { ?>
          <tr>
            <th scope="row"><?= $details['product_title'] ?></th>
            <td>
              <p><?= $details['quantity'] ?> st</p>
            </td>
            <td><?= $details['unit_price'] ?> kr</td>
          </tr>
        <?php } ?>
      </tbody>

      <tfoot>
        <tr>
          <td></td>
          <td></td>
          <th scope="row">Totalsumma: <?= $details['total_price'] ?> kr</th>
        </tr>
      </tfoot>

    </table>

    <form action="user.php">
      <input type="submit" class="btn btn-secondary float-left btn-margin" value="&#x2190; Tillbaka">
    </form>

  </div>
</div>




<script src="../js/update-user-logged-in.js"></script>

<!-- Prevent +1(form) on reload page -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>


<?php include('../layout/footer.php'); ?>