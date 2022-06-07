<?php
  require('../src/config.php');

  $sql = "
    SELECT * 
    FROM products
		";
  $stmt = $pdo->query($sql);
  $items = $stmt->fetchAll();
?>

<!doctype html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- <link rel="stylesheet" href="css/styles.css"> -->
      <title>Shop</title>
    </head>
    <body>
      <div class="container">
        <div class="row">
          <h2>Shop items</h2>
        </div>
        <div>
          <?php foreach($items as $item) { ?>
            <div class="item">
              <h4 class="item-title"><?=htmlentities($item['title'])?></h4>
              <h6><?=htmlentities($item['description'])?></h6>
              <h6 class="title"><?=htmlentities($item['price'])?></h5>
              <p class="content"><?=htmlentities($item['stock'])?></p>
              <!-- <form action="item.php" method="GET">
                  <input type="hidden" name="itemId" value="<?=htmlentities($item['id']) ?>">
                  <input type="submit" value="Read more">
              </form> -->
            </div>
          <?php } ?>
        </div>
      </div>
    </body>
  </html>