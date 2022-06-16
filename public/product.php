<?php
  require('../src/config.php');
  $pageTitle = "Product";
  
  if (!isset($_GET['productId']) || !is_numeric($_GET['productId'])) {
      header('Location: index.php?invalidproduct');
      exit;
  }

  $sql = "
      SELECT * FROM products
      WHERE id = :id
  ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $_GET['productId']);
  $stmt->execute();
  $product = $stmt->fetch();
?>

<?php include('layout/header.php'); ?>
  <div class="container">
  <div class="row">
    <div class="info">
      <p><b>POSTERS FRÅN  NORGE</b><p>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque feugiat accumsan vel, est vitae. Hac elit nibh dui in neque eget arcu. Urna aliquet posuere at senectus erat. Pretium sem tincidunt.<p>
    </div>
    </div>
    <div class="product-singel">

    <div class="product-image">

     <ul id="Frames">
        <li class="Frame">
          <img src="./img/<?= htmlentities($product["img_url"]) ?>"  alt="<?= htmlentities($product["title"]) ?>">
        </li>
     </ul>
    </div>
    <div class="product-text">
      <h5><?=htmlentities($product['title'])?></h5>
      <p><?=htmlentities($product['description'])?></p>
      <p class="stock">Lager: <?=htmlentities($product['stock'])?> st</p>
      <button type="submit" name="doLogin" class="btn btn-primary btn-block mb-4">LÄGG I VARUKORG</button>
      <p class="price"><b><?=htmlentities($product['price'])?> KR</b></p>
      </div>
    </div>
    <p>
      <a href="index.php">Back</a>
    </p>
  </div>
  <?php include('layout/footer.php'); ?>

