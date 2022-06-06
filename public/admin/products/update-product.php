<?

require('../../../src/config.php');

if (isset($_POST["updateProduct"])) {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    $stock = trim($_POST["stock"]);

    $sql = "
    UPDATE products
    SET description = :description, title = :title,
    price = :price, stock = :stock
    WHERE id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['productID']);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':stock', $stock);
    $stmt->execute();
}
     
$sql = "
SELECT * FROM products
WHERE id = :id
";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['productID']);
$stmt->execute();
$singleProduct = $stmt->fetch();
?>

<form action="./products.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST">
    <input type="text" class="form-control" name="title" placeholder="Title" value="<?= htmlentities($singleProduct["title"]) ?>" ><br>
    <textarea rows="6" cols="60" class="form-control" name="description" placeholder="Description"><?= htmlentities($singleProduct["description"]) ?></textarea><br>
    <input type="number" class="form-control"  name="price" placeholder="Price" value="<?= htmlentities($singleProduct["price"]) ?>"><br>
    <input type="number" class="form-control"  name="stock" placeholder="Stock" value="<?= htmlentities($singleProduct["stock"]) ?>"><br>
    <input type="submit" name="updateProduct" class="btn btn-outline-primary" value="Update"><br>
</form>