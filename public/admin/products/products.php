<?

require('../../../src/config.php');

if (isset($_POST["deleteProductBTN"])) {
    $sql = "
    DELETE FROM products
    WHERE id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $_POST['productID']);
    $stmt->execute();
}
    
    
if (isset($_POST["clearAllproducts"])) {
    $sql = "
    DELETE FROM products
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

    $stmt = $pdo->query("SELECT * FROM products");
    $products = array_reverse($stmt->fetchAll());

// Ovan skrivs om till klasser

?>

<div class="top-buttons">
    <form action="./create-new-product.php">
        <input type="submit" class="btn btn-outline-primary" value="Create new product">
    </form>
    <form action="" method="POST">
        <input type="submit" name="clearAllproducts" class="btn btn-outline-secondary" value="Clear all">
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <!-- <th>Image</th> -->
            <th>Manage</th>
        </tr>
    </thead>
    <br>
    <tbody>
        <? foreach ($products as $product) : ?>
            <tr>
                <td><?= htmlentities($product["id"]) ?></td>
                <td><?= htmlentities($product["title"]) ?></td>
                <td><?= htmlentities($product["description"]) ?></td>
                <td><?= htmlentities($product["price"]) ?> €</td>
                <td><?= htmlentities($product["stock"]) ?></td>
                <td class="action">
                    <form action="./update-product.php" method="GET">
                        <input type="hidden" name="productID" value="<?= htmlentities($product["id"]) ?>">
                        <input type="submit" class="btn btn-dark" value="Update">
                    </form>
                    <form action="" method="POST">
                        <input type="hidden" name="productID" value="<?= $product['id'] ?>">
                        <input type="submit" name="deleteProductBTN" class="btn btn-dark" value="Delete">
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>