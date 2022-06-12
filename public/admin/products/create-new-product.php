<?
require('../../../src/config.php');
$pageTitle = "Create new product";

$title = "";
$description = "";
$price = "";
$stock = "";

if (isset($_POST["addNewProduct"])) {

    if (is_uploaded_file($_FILES['img_url']['tmp_name'])) {
        $fileName         = $_FILES['img_url']['name'];
        $fileType         = $_FILES['img_url']['type'];
        $fileTempPath   = $_FILES['img_url']['tmp_name'];
        $path             = '../../img/';
        $newFilePath = $path . $fileName;
    }

    move_uploaded_file($fileTempPath, $newFilePath);

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    $stock = trim($_POST["stock"]);
    $img = $fileName;

    $sql = "
        INSERT INTO products (title, description, price, stock, img_url) 
        VALUES (:title, :description, :price, :stock, :img_url);
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":stock", $stock);
    $stmt->bindParam(":img_url", $img);
    $stmt->execute();
}
?>

<?php include('../layout/header.php'); ?>

<form action="../index.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST" class="form-group" enctype="multipart/form-data">
    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= htmlentities($title) ?>"><br>
    <textarea rows="6" cols="60" class="form-control" id="description" name="description" placeholder="Description"><?= htmlentities($description) ?></textarea><br>
    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="price" name="price" placeholder="Price" value="<?= htmlentities($price) ?>"><br>
    <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?= htmlentities($stock) ?>"><br>
    <label for="image">Add image:</label><br>
    <input type="file" class="form-control" id="image" name="img_url" placeholder="Add image"><br><br>
    <input type="submit" name="addNewProduct" class="btn btn-outline-primary" value="Create new product"><br>
</form>

<? include('../../layout/footer.php'); ?>