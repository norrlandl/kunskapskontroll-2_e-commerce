<?php
require('../src/config.php');
$pageTitle = "Våra produkter";

$products = $userDbHandler->fetchAllFromDb("products");
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
  <div class="wrapping">
    <?php foreach ($products as $product) {

      $info = preg_replace('/\s+?(\S+)?$/', '', substr($product['description'], 0, 55));

    ?>

      <div class="product">

        <a href="product.php?id=<?= $product['id'] ?>" name="productId">
          <ul id="Frames">
            <li class="Frame">
              <img src="./img/<?= htmlentities($product["img_url"]) ?>" alt="<?= htmlentities($product["title"]) ?>">
            </li>
          </ul>
        </a>
        <div class="product-info">
          <p class="product-title"><?= htmlentities($product['title']) ?></p>
          <p><i><?= htmlentities($info) ?></i></p>
          <p><b><?= htmlentities($product['price']) ?> kr</b></p>

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
            <!-- <input type="number" class="btn btn-2" name="quantity" value="1" min="0"> -->
            <input type="submit" class="btn btn-primary btn-2" name="addToCart" value="KÖP">

          </form>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include('layout/footer.php'); ?>