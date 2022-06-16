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
    <div class="info">
      <p><b>POSTERS FRÅN  NORGE</b><p>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque feugiat accumsan vel, est vitae. Hac elit nibh dui in neque eget arcu. Urna aliquet posuere at senectus erat. Pretium sem tincidunt.<p>
    </div>
    </div>
    <div class="wrapping">
      <?php foreach($products as $product) { 
        
        $info = preg_replace('/\s+?(\S+)?$/', '', substr($product['description'], 0, 55));
        
        ?>

        <div class="product">
          <!-- <p class="content"><?=htmlentities($product['stock'])?></p> -->

          <ul id="Frames">
            <li class="Frame">
              <img src="./img/<?= htmlentities($product["img_url"]) ?>"  alt="<?= htmlentities($product["title"]) ?>">
              
            </li>
          </ul>
          
      
          <p class="product-title"><?=htmlentities($product['title'])?></p> 
          <p><i><?=htmlentities($info)?></i></p>
          <p><b><?=htmlentities($product['price'])?> kr</b></p>

          <form action="product.php" method="GET">
              <input type="hidden" name="productId" value="<?=htmlentities($product['id']) ?>">
              <input type="submit" value="Read more">
          </form>
      

        </div>
      <?php } ?>
    </div>
</div>

<?php include('layout/footer.php'); ?>