<?php
require('../../../src/config.php');
$pageTitle = "Update product";

if (isset($_POST["updateProduct"])) {
    $UserDbHandler->updateProduct(
        $title = trim($_POST["title"]),
        $description = trim($_POST["description"]),
        $price = trim($_POST["price"]),
        $stock = trim($_POST["stock"])
    );

    redirect("../index.php");
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

<?php include('../layout/header.php'); ?>

<form action="../index.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>

<form action="" method="POST">

    <label for="title">Title:</label><br>
    <input type="text" class="form-control" name="title" value="<?= htmlentities($singleProduct["title"]) ?>"><br>
    <label for="description">Description:</label><br>
    <textarea rows="6" cols="60" class="form-control" name="description"><?= htmlentities($singleProduct["description"]) ?>
        </textarea><br>
    <label for="price">Price:</label><br>
    <input type="number" class="form-control" name="price" placeholder="Price" value="<?= htmlentities($singleProduct["price"]) ?>"><br>
    <label for="stock">Stock:</label><br>
    <input type="number" class="form-control" name="stock" placeholder="Stock" value="<?= htmlentities($singleProduct["stock"]) ?>"><br>
    <input type="submit" name="updateProduct" class="btn btn-outline-primary" value="Update"><br>

</form>

<?php include('../../layout/footer.php'); ?>