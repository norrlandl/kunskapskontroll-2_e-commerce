<?php
require('../src/config.php');
$pageTitle = "Product";

// if (!isset($_GET['productId']) || !is_numeric($_GET['productId'])) {
//     header('Location: index.php?invalidproduct');
//     exit;
// }

// echo "<pre>";
// print_r($_GET);
// echo "</pre>";


$sql = "
      SELECT * FROM products
      WHERE id = {$_GET['id']}
  ";

$stmt = $pdo->prepare($sql);
// $stmt->bindParam(':id', $_GET['productId']);
$stmt->execute();
$product = $stmt->fetch();

?>

<?php

$sorted_array = $userDbHandler->fetchAllFromDb("products");

$shuffled_array = array();

$keys = array_keys($sorted_array);
shuffle($keys);

foreach ($keys as $key) {
  $shuffled_array[$key] = $sorted_array[$key];
}

$filter_marks = array_filter(
  $shuffled_array,
  function ($shuffled_array) {
    return $shuffled_array["id"] <= 4;
  }
);

?>

<?php include('layout/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="info">
      <p><b>POSTERS FRÅN NORGE</b>
      <p>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque feugiat accumsan vel, est vitae. Hac elit nibh dui in neque eget arcu. Urna aliquet posuere at senectus erat. Pretium sem tincidunt.
      <p>
    </div>
  </div>
  <div class="product-singel">

    <div class="product-image">

      <ul id="Frames">
        <li class="Frame">
          <img src="./img/<?= htmlentities($product["img_url"]) ?>" alt="<?= htmlentities($product["title"]) ?>">
        </li>
      </ul>
    </div>
    <div class="product-text">
      <h5><?= htmlentities($product['title']) ?></h5>
      <p><?= htmlentities($product['description']) ?></p>
      <p class="stock">Lager: <?= htmlentities($product['stock']) ?> st</p>

      <!-- <button type="submit" name="addToCart" class="btn btn-primary btn-block mb-4">LÄGG I VARUKORG</button> -->
      <form action="cart/add-cart-item.php" method="POST">
        <input type="hidden" name="productId" value="<?= $product['id'] ?>">
        <div class="input-group mb-3">
          <select class="custom-select" id="quantity" name="quantity">

            <?php

            for ($i = 1; $i <= $product['stock']; $i++) {
              echo "<option value=" . $i . ">" . $i . "</option>";
            }
            ?>
          </select>

        </div>
        <input type="submit" class="btn btn-primary btn-2" name="addToCart" value="KÖP">
      </form>
      <p class="price"><b><?= htmlentities($product['price']) ?> KR</b></p>

    </div>
  </div>
  <p>
    <a href="index.php">Back</a>
  </p>
  <section class="slider-products">
    <div class="slider-title">
      <h1 class="title__main">Du kanske också gillar?</h1>
    </div>
    <br>
    <br>
    <div class="slider-gallery">
      <div class="slider-container">
        <?php foreach ($filter_marks as $item) : ?>
          <div class="panel">
            <h3><?= $item["title"] ?></h3>
            <img src="./img/<?= $item["img_url"] ?>" alt="<?= $item["title"] ?>">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</div>
<script src="../public/js/slider-products.js"></script>
<?php include('layout/footer.php'); ?>