<?

require('../../../src/config.php');

$title = "";
$description = "";
$price = "";
$stock = "";
//$img

if (isset($_POST["addNewProduct"])) {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    $stock = trim($_POST["stock"]);
    //$img

    $sql = "
    INSERT INTO products (title, description, price, stock) 
    VALUES (:title, :description, :price, :stock);
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":stock", $stock);
    //$img
    $stmt->execute();
}
?>  

<form action="./products.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST" class="form-group">
    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= htmlentities($title) ?>"><br>
    <textarea rows="6" cols="60" class="form-control" id="description" name="description" placeholder="Description"><?= htmlentities($description) ?></textarea><br>
    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="price" name="price" placeholder="Price" value="<?= htmlentities($price) ?>"><br>
    <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?= htmlentities($stock) ?>"><br>
    <!-- $img -->
    <input type="submit" name="addNewProduct" class="btn btn-outline-primary" value="Create new product"><br>
</form>