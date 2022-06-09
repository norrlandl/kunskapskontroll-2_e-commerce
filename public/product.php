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
    <!-- <div class="row">
      <h2>Product</h2>
      <a class="link" href="posts.php">Posts</a>
    </div> -->
    <div class="product">
      <h4 class="product-title"><?=htmlentities($product['title'])?></h4>
      <p><?=htmlentities($product['description'])?></p>
      <p class="title"><?=htmlentities($product['price'])?></p>
      <p class="content"><?=htmlentities($product['stock'])?></p>
      <p>
        <a href="index.php">Back</a>
      </p>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>

