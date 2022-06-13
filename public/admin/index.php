<?php
  require('../../src/config.php');
  $pageTitle = "Admin";
  include('./layout/header.php');

  if (!isset($_SESSION['email'])) {
    header("Location: ./admin-login.php?mustLogin");
  }

  if (isset($_POST["deleteProductBTN"])) {
    $sql = "
            DELETE FROM products
            WHERE id = :id;
            ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $_POST['productID']);
    $stmt->execute();
  }

  if (isset($_POST["clearAllproducts"])) {
    $sql = " DELETE FROM products ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
  }


  $stmt = $pdo->query("SELECT * FROM products");
  $products = array_reverse($stmt->fetchAll());
  ?>

  <div class="wrapper">
    <h1>Welcome (admin)!</h1>
    <h2>All products</h2>
    <div class="top-buttons">
      <form action="./products/create-new-product.php">
        <input type="submit" class="btn btn-outline-primary" value="Create new product" />
      </form>
      <form action="" method="POST">
        <input type="submit" name="clearAllproducts" class="btn btn-outline-secondary" value="Clear all" />
      </form>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Price</th>
          <th>Stock</th>
          <th>Image</th>
          <th>Manage</th>
        </tr>
      </thead>
      <br />
      <tbody>
        <?php foreach ($products as $product) : ?>
          <tr>
            <td><?= htmlentities($product["id"]) ?></td>
            <td><?= htmlentities($product["title"]) ?></td>
            <td><?= htmlentities($product["description"]) ?></td>
            <td>
              <?= htmlentities($product["price"]) ?>
              €
            </td>
            <td><?= htmlentities($product["stock"]) ?></td>
            <td><img src="../img/<?= htmlentities($product["img_url"]) ?>" width="60px" height="60px" alt="<?= htmlentities($product["title"]) ?>"></td>
            <td class="action">
              <form action="./products/update-product.php" method="GET">
                <input type="hidden" name="productID" value="<?= htmlentities($product["id"]) ?>">
                <input type="submit" class="btn btn-dark" value="Update" />
              </form>
              <form action="" method="POST">
                <input type="hidden" name="productID" value="<?= $product['id'] ?>" />
                <input type="submit" name="deleteProductBTN" class="btn btn-dark" value="Delete" />
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php

    if (isset($_POST["deleteUserBTN"])) {
      $sql = "
      DELETE FROM users
      WHERE id = :id;
      ";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":id", $_POST['userID']);
      $stmt->execute();
    }
    if (isset($_POST["clearAllUsers"])) {
      $sql = " DELETE FROM users ";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
    }
    $stmt = $pdo->query("SELECT * FROM users");
    $users = array_reverse($stmt->fetchAll());
    ?>

    <h2>All users</h2>
    <div class="top-buttons">
      <form action="./users/create-new-user.php">
        <input type="submit" class="btn btn-outline-primary" value="Create new user" />
      </form>
      <form action="" method="POST">
        <input type="submit" name="clearAllUsers" class="btn btn-outline-secondary" value="Clear all" />
      </form>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Second Name</th>
          <th>Email</th>
          <th>Manage</th>
        </tr>
      </thead>
      <br />
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
                <input type="submit" class="btn btn-dark" value="Update" />
              </form>
              <form action="" method="POST">
                <input type="hidden" name="userID" value="<?= $user['id'] ?>" />
                <input type="submit" name="deleteUserBTN" class="btn btn-dark" value="Delete" />
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <? include('../layout/footer.php'); ?>