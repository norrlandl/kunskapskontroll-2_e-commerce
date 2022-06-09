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
          <h4 class="product-title"><?=htmlentities($product['title'])?></h4>
          <p><?=htmlentities($product['description'])?></p>
          <p class="title"><?=htmlentities($product['price'])?></p>
          <p class="content"><?=htmlentities($product['stock'])?></p>
          <img src="./img/<?= htmlentities($product["img_url"]) ?>" width="180px" height="200px" alt="<?= htmlentities($product["title"]) ?>">
          <form action="product.php" method="GET">
              <input type="hidden" name="productId" value="<?=htmlentities($product['id']) ?>">
              <input type="submit" value="Read more">
          </form>
        </div>
      <?php } ?>
    </div>
</div>

<?php include('layout/footer.php'); ?>