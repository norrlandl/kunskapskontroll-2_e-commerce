<!DOCTYPE html>
<html>
	<head>
		<title>Admin</title>
	</head>
	<body>
	<h1>Welcome admin!</h1>
<? require('../../src/config.php');

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

<h2>Manage products</h2>
<div class="top-buttons">
    <form action="./products/create-new-product.php">
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


<hr>
<br>
<br>

<?


if (isset($_POST["deleteUserBTN"])) {
    $sql = "
    DELETE FROM users
    WHERE id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $_POST['userID']);
    $stmt->execute();
}
    
    
if (isset($_POST["clearAllUsers"])) {
    $sql = "
    DELETE FROM users
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

    $stmt = $pdo->query("SELECT * FROM users");
    $users = array_reverse($stmt->fetchAll());

// Ovan skrivs om till klasser

?>

<h2>Manage users</h2>
<div class="top-buttons">
    <form action="./users/create-new-user.php">
        <input type="submit" class="btn btn-outline-primary" value="Create new user">
    </form>
    <form action="" method="POST">
        <input type="submit" name="clearAllUsers" class="btn btn-outline-secondary" value="Clear all">
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Second Name</th>
            <th>Email</th>
            <th>Manage</th>
        </tr>
    </thead>
    <br>
    <tbody>
        <? foreach ($users as $user) : ?>
            <tr>
                <td><?= htmlentities($user["id"]) ?></td>
                <td><?= htmlentities($user["first_name"]) ?></td>
                <td><?= htmlentities($user["last_name"]) ?></td>
                <td><?= htmlentities($user["email"]) ?></td>
                <td class="action">
                    <form action="./update-user.php" method="GET">
                        <input type="hidden" name="userID" value="<?= htmlentities($user["id"]) ?>">
                        <input type="submit" class="btn btn-dark" value="Update">
                    </form>
                    <form action="" method="POST">
                        <input type="hidden" name="userID" value="<?= $user['id'] ?>">
                        <input type="submit" name="deleteUserBTN" class="btn btn-dark" value="Delete">
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>





<!-- adasdasda -->


</body>
</html>