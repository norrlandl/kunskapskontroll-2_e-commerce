<?php
  require('../src/config.php');
  $pageTitle = "Products";

  $sql = "
    SELECT * 
    FROM products
		";
  $stmt = $pdo->query($sql);
  $products = $stmt->fetchAll();
?>

<?php include('layout/header.php'); ?>

  <div class="container">
    <div class="row">
      <h2>Shop products</h2>
    </div>
    <div class="row wrapping">
      <?php foreach($products as $product) { ?>
        <div class="product">
          <!-- <p class="content"><?=htmlentities($product['stock'])?></p> -->
          <ul id="Frames">
            <li class="Frame">
              <a href="">
                <img src="./img/<?= htmlentities($product["img_url"]) ?>" width="224px" height="280px" style="object-fit: cover" alt="<?= htmlentities($product["title"]) ?>">
              </a>
            </li>
            <h4 class="product-title"><?=htmlentities($product['title'])?></h4>
            <p><?=htmlentities($product['description'])?></p>
            <p class="title"><?=htmlentities($product['price'])?></p>
          </ul>
         
          <form action="product.php" method="GET">
              <input type="hidden" name="productId" value="<?=htmlentities($product['id']) ?>">
              <input type="submit" value="Read more">
          </form>
        </div>
      <?php } ?>
    </div>
</div>

<?php include('layout/footer.php'); ?>