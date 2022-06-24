<?php

require('../../../src/config.php');
$pageTitle = "Uppdatera produkt";

if (isset($_POST["updateProduct"])) {
    $userDbHandler->updateProduct(
        $_GET['productID'],
        trim($_POST["title"]),
        trim($_POST["description"]),
        trim($_POST["price"]),
        trim($_POST["stock"])
    );

    redirect("../index.php");
}

$singleProduct = $userDbHandler->fetchById($_GET['productID'], "products");

?>

<?php include('../layout/header.php'); ?>
<div class="page-wrapper">
    <form action="../index.php">
        <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Tillbaka">
    </form>

    </br>
    </br>

    <form action="" method="POST">

        <label for="title">Titel:</label><br>
        <input type="text" class="form-control" name="title" value="<?= htmlentities($singleProduct["title"]) ?>"><br>
        <label for="description">Beskrivning:</label><br>
        <textarea rows="6" cols="60" class="form-control" name="description"><?= htmlentities($singleProduct["description"]) ?>
        </textarea><br>
        <label for="price">Pris:</label><br>
        <input type="number" class="form-control" name="price" placeholder="Price" value="<?= htmlentities($singleProduct["price"]) ?>"><br>
        <label for="stock">Lagerantal:</label><br>
        <input type="number" class="form-control" name="stock" placeholder="Stock" value="<?= htmlentities($singleProduct["stock"]) ?>"><br>
        <input type="submit" name="updateProduct" class="btn btn-outline-primary" value="Uppdatera"><br>

    </form>
</div>

<?php include('../../layout/footer.php'); ?>