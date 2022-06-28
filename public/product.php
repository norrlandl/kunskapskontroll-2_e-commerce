<?php
require('../src/config.php');
$pageTitle = "Product";

// if (!isset($_GET['productId']) || !is_numeric($_GET['productId'])) {
//     header('Location: index.php?invalidproduct');
//     exit;
// }

$product = $globalDbHandler->fetchById($_GET['id'], "products");

// Slider 

$sorted_array = $globalDbHandler->fetchAllFromDb("products");
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
      <h2><?= htmlentities($product['title']) ?></h2>
      <p><?= htmlentities($product['description']) ?></p>
      <p class="stock">I lager: <?= htmlentities($product['stock']) ?> st</p>
      <h4 class="price"><?= htmlentities($product['price']) ?>:-</h4>
      <br>
      <form class="buy-button">
        <input type="hidden" name="productId" value="<?= $product['id'] ?>">
        <div class="input-group mb-3">
          <select class="custom-select" id="quantity" name="quantity">

        <h2><?= htmlentities($product['title']) ?></h2>
        <p><?= htmlentities($product['description']) ?></p>
        <p class="stock">I lager: <?= htmlentities($product['stock']) ?> st</p>
      </div>
      <div class="product-text-2">
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
        <div class="price-shipping">
          <div class="price">
            <p class="price"><?= htmlentities($product['price']) ?> kr</p>
          </div>
          <div class="shipping">
            <p>Fraktfritt över 599 kr</p>
            <p>Leverans 2-4 arbetsdagar</p>
          </div>

        </div>
      </div>
    </div>
  </div>
  <section class="slider-products">
    <div class="slider-title">
      <h1 class="title__main">Du kanske också gillar?</h1>
    </div>
    <br>
    <br>
    <div class="slider-gallery">
      <div class="slider-container">
        <?php foreach ($filter_marks as $item) { ?>
          <div class="panel">
            <h3><?= $item["title"] ?></h3>
            <img src="/kunskapskontroll-2_e-commerce/public/img/<?= $item["img_url"] ?>" alt="<?= $item["title"] ?>">
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</div>
<script src="../public/js/slider-products.js"></script>
<script src="/kunskapskontroll-2_e-commerce/public/js/cart.js"></script>
<?php include('layout/footer.php'); ?>