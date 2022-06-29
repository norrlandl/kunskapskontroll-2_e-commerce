<?php
require('../../src/config.php');
$pageTitle = "Användare";
$pageId    = "user-order-details";


if (!isset($_SESSION['email'])) {
  header("Location: ./user-login.php?mustLogin");
}

debug($_GET['id']);

$error = "";
$message = "";
$orderDetails = "";
$newOrderDate = "";

$orderDetails = $globalDbHandler->getOrder($_GET['id'], "order_items");





?>

<?php include('../layout/header.php'); ?>

<?php ?>

<?= $message ?>

<div class="container">
  <div class="row">
    <div class="info">
      <p><b>Välkommen <?= ucfirst($user['first_name']) ?>!</b></p>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque.
      </p>
    </div>
  </div>

  <div class="container-small">
    <h4>Tidigare ordrar</h4>
    <!-- <table class="table table-user">


      <thead>
        <tr>
          <th scope="col">Order</th>
          <th scope="col">Datum</th>
          <th scope="col" colspan="2">Total summa</th>
          <th scope="col">Mer</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($userOrders as $orders) {

          $createDate = new DateTime($orders['create_date']);
          $newDate = $createDate->format('Y-m-d');

        ?>
          <tr>
            <th scope="row">#<?= $orders['id'] ?></th>
            <td>
              <p><?= $newDate ?></p>
            </td>
            <td colspan="2"><?= $orders['total_price'] ?> kr</td>
            <td>
              <form action="" method="POST">
                <input type="hidden" name="ordersID" value="<?= htmlentities($orders['id']) ?>">
                <input type="submit" name="orderDetails" value="Se detaljer" class="btn btn-outline-info">
              </form>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderDetailsModal">
                modal
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>


      <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tfoot>

    </table> -->
  </div>

  <div class="container-small">
    <h4>Mina uppgifter</h4>

    <h5 class="modal-title" id="exampleModalLabel">Ordernummer #<?= $orderDetails['0']['order_id'] ?> <br> <i><?= $newOrderDate ?></i></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

    <div class="modal-body">
      <table class="table table-order">


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
            <th scope="row">Totalsumma: <?= $details['total_price'] ?> kr</th>
            <td></td>
            <td></td>
          </tr>
        </tfoot>

      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
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