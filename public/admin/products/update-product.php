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

    if (!is_uploaded_file($_FILES['img_url']['tmp_name'])) {
        $error .= "<li>En bild måste laddas upp</li>";
    }


    if ($error) {
        $message = "
            <ul class='alert alert-danger list-unstyled'>
                $error
            </ul>
            ";
    } else {

        if (is_uploaded_file($_FILES['img_url']['tmp_name'])) {
            $fileName         = $_FILES['img_url']['name'];
            $fileType         = $_FILES['img_url']['type'];
            $fileTempPath   = $_FILES['img_url']['tmp_name'];
            $path             = '../../img/';
            $newFilePath = $path . $fileName;
        }

        $allowedFileTypes = [
            'image/png',
            'image/jpeg',
            'image/gif',
        ];

        $isFileTypeAllowed = array_search($fileType, $allowedFileTypes, true);

        if (!$isFileTypeAllowed) {
            $error .= "<li>Filtyp inte tillåten.</li>";
        }

        if ($_FILES['img_url']['size'] > 10000000) {
            $error .= "<li>För stor fil. Max är 10 MB.</li>";
        } else {

            move_uploaded_file($fileTempPath, $newFilePath);
            $img = $fileName;


            $productDbHandler->updateProduct(
                $_GET['productID'],
                $title,
                $description,
                $price,
                $stock,
                $img
            );
            redirect("../index.php");
        }
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

        <div class="form-group">
            <div class="mb-3">
                <label for="image" class="form-label">Produktfoto</label>
                <input type="file" id="image" name="img_url" class="form-control" placeholder="Add image">
            </div>
            <!-- <label for="stock">Produktfoto</label><br>
      <label class="btn-file-upload btn btn-outline-info" for="image">&#43; Välj bild
        <input type="file" id="image" name="img_url" placeholder="Add image"></label> -->
        </div>

        <input type="submit" name="updateProduct" class="btn btn-success float-right btn-margin" value="&#10003; Uppdatera">

    </form>
    <form action="../index.php">
        <input type="submit" class="btn btn-secondary float-left btn-margin" value="&#x2190; Tillbaka">
    </form>
</div>

<?php include('../layout/footer.php'); ?>