<?php

require('../../src/config.php');
$pageTitle = "Admin";
include('./layout/header.php');

if (!isset($_SESSION['email'])) {
  header("Location: ./admin-login.php?mustLogin");
}

/* Products */

if (isset($_POST["deleteProductBTN"])) {
  $globalDbHandler->deleteFromDb($_POST['productID'], "products");
}

if (isset($_POST["clearAllproducts"])) {
  $globalDbHandler->clearTableInDb("products");
}

$products = $globalDbHandler->fetchAllFromDb("products");

/* Users */

if (isset($_POST["deleteUserBTN"])) {

  if ($_SESSION['id'] == $_POST['userID']) {
    $globalDbHandler->deleteFromDb($_POST['userID'], "users");
    redirect("admin-login.php?userDeleted");
  } else {
    $globalDbHandler->deleteFromDb($_POST['userID'], "users");
  }
}

if (isset($_POST["clearAllUsers"])) {
  $globalDbHandler->clearTableInDb("users");
  redirect("admin-login.php?tableDeleted");
}

$users = $globalDbHandler->fetchAllFromDb("users");

?>

<!-- ALL PRODUCTS -->

<div class="wrapper">
  <h1>Hej, <?= ucfirst($_SESSION['first_name']) ?>!</h1>

  <h2>Produkter</h2>
  <div class="top-buttons">
    <form action="./products/create-new-product.php">
      <input type="submit" class="btn btn-info" value="&#43; Skapa ny" />
    </form>
    <form action="" method="POST">
      <input type="submit" name="clearAllproducts" class="btn btn-warning" value="&#10006; Rensa alla" />
    </form>
  </div>

  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Bild</th>
        <th scope="col">Titel</th>
        <th scope="col">Beskrivning</th>
        <th scope="col">Pris</th>
        <th scope="col">Lagerantal</th>
        <th scope="col">Hantera</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <tr>
          <td><?= htmlentities($product["id"]) ?></td>
          <td><img src="../img/<?= htmlentities($product["img_url"]) ?>" width="60px" height="60px" alt="<?= htmlentities($product["title"]) ?>"></td>
          <th><?= htmlentities($product["title"]) ?></th>
          <td><?= htmlentities(substr($product["description"], 0, 32)) ?>...</td>
          <td>
            <?= htmlentities($product["price"]) ?> kr
          </td>
          <td><?= htmlentities($product["stock"]) ?> </td>
          <td class="action">
            <form action="./products/update-product.php" method="GET">
              <input type="hidden" name="productID" value="<?= htmlentities($product["id"]) ?>">
              <input type="submit" class="btn btn-outline-success" value="Uppdatera" />
            </form>
            <form action="" method="POST">
              <input type="hidden" name="productID" value="<?= $product['id'] ?>" />
              <input type="submit" name="deleteProductBTN" class="btn btn-outline-danger" value="&#33; Radera" />
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- ALL USERS -->
  <h2>Användare</h2>
  <div class="top-buttons">
    <form action="./users/create-new-user.php">
      <input type="submit" class="btn btn-info" value="&#43; Skapa ny" />
    </form>
    <form action="" method="POST">
      <input type="submit" name="clearAllUsers" class="btn btn-warning" value="&#10006; Rensa alla" />
    </form>
  </div>

  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Förnamn</th>
        <th>Efternamn</th>
        <th>Email</th>
        <th>Hantera</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?= htmlentities($user["id"]) ?></td>
          <td><?= htmlentities($user["first_name"]) ?></td>
          <td><?= htmlentities($user["last_name"]) ?></td>
          <td><?= htmlentities($user["email"]) ?></td>
          <td class="action">
            <form action="./users/update-user.php" method="GET">
              <input type="hidden" name="userID" value="<?= htmlentities($user["id"]) ?>">
              <input type="submit" class="btn btn-outline-success" value="Uppdatera" />
            </form>
            <form action="" method="POST">
              <input type="hidden" name="userID" value="<?= $user['id'] ?>" />
              <input type="submit" name="deleteUserBTN" class="btn btn-outline-danger" value="&#33; Radera" />
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>

<?php include('./layout/footer.php'); ?>