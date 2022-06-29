<?php

require('../../../src/config.php');
$pageTitle = "Uppdatera produkt";

$error = "";
$message = "";

if (isset($_POST["updateProduct"])) {


    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $stock = trim($_POST['stock']);


    if (empty($title)) {
        $error .= "<li>Titel är obligatoriskt </li>";
    }

    if (empty($description)) {
        $error .= "<li>Beskrivning är obligatoriskt</li>";
    }

    if (empty($price)) {
        $error .= "<li>Pris är obligatoriskt</li>";
    }

    if (empty($stock)) {
        $error .= "<li>Lagerantal är obligatoriskt</li>";
    }

    if ($error) {
        $message = "
            <ul class='alert alert-danger list-unstyled'>
                $error
            </ul>
            ";
    } else {

        $productDbHandler->updateProduct(
            $_GET['productID'],
            $title,
            $description,
            $price,
            $stock
        );

        redirect("../index.php");
    }
}

$singleProduct = $globalDbHandler->fetchById($_GET['productID'], "products");

?>

<?php include('../layout/header.php'); ?>
<div class="page-wrapper">

    <h4>Uppdatera produkt</h4>

    <?= $message ?>

    <form action="" method="POST">

        <div class="form-group">
            <label for="title">Titel</label>
            <input type="text" class="form-control" name="title" value="<?= htmlentities($singleProduct["title"]) ?>">
        </div>

        <div class="form-group">
            <label for="description">Beskrivning</label>
            <textarea rows="6" cols="60" class="form-control" name="description"><?= htmlentities($singleProduct["description"]) ?>
        </textarea>
        </div>

        <div class="form-group">
            <label for="price">Pris</label>
            <input type="number" class="form-control" name="price" value="<?= htmlentities($singleProduct["price"]) ?>">
        </div>

        <div class="form-group">
            <label for="stock">Lagerantal</label>
            <input type="number" class="form-control" name="stock" value="<?= htmlentities($singleProduct["stock"]) ?>"><br>
        </div>

        <input type="submit" name="updateProduct" class="btn btn-success float-left btn-margin" value="&#10003; Uppdatera">

    </form>
    <form action="../index.php">
        <input type="submit" class="btn btn-secondary float-right btn-margin" value="&#x2190; Tillbaka">
    </form>
</div>

<?php include('../layout/footer.php'); ?>