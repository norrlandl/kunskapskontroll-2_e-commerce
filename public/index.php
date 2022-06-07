<?php
  require('../src/config.php');

  $sql = "
    SELECT * 
    FROM products
		";
  $stmt = $pdo->query($sql);
  $products = $stmt->fetchAll();
?>

<!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="css/products.css">
      <title>Shop</title>
    </head>
    <body>
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
              <form action="product.php" method="GET">
                  <input type="hidden" name="productId" value="<?=htmlentities($product['id']) ?>">
                  <input type="submit" value="Read more">
              </form>
            </div>
          <?php } ?>
        </div>
      </div>
    </body>
  </html>