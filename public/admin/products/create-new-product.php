<?php
require('../../../src/config.php');
$pageTitle = "Skapa ny produkt";

$error = "";
$message = "";

$title = "";
$description = "";
$price = "";
$stock = "";

if (isset($_POST["addNewProduct"])) {
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

      $productDbHandler->addProductToDb(
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
?>

<?php include('../layout/header.php'); ?>

<div class="page-wrapper">

  <h4>Skapa ny produkt</h4>

  <?= $message ?>

  <form action="" method="POST" class="form-group" enctype="multipart/form-data">

    <div class="form-group">
      <label for="title">Titel</label>
      <input type="text" class="form-control" id="title" name="title" value="<?= htmlentities($title) ?>">
    </div>

    <div class="form-group">
      <label for="description">Beskrivning</label>
      <textarea rows="6" cols="60" class="form-control" id="description" name="description"><?= htmlentities($description) ?></textarea>
    </div>

    <div class="form-group">
      <label for="price">Pris</label>
      <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="price" name="price" value="<?= htmlentities($price) ?>">
    </div>

    <div class="form-group">
      <label for="stock">Lagerantal</label>
      <input type="number" class="form-control" id="stock" name="stock" value="<?= htmlentities($stock) ?>">
    </div>

    <div class="form-group">
      <!-- <div class="mb-4">
        <label for="image" class="form-label">Produktfoto</label>
        <input type="file" id="image" name="img_url" class="form-control" placeholder="Add image">
      </div> -->
      <label for="img">Produktfoto</label><br>
      <label class="btn-file-upload btn btn-outline-grey" for="image">
        <input type="file" id="image" name="img_url" placeholder="Add image"></label>
    </div>

    <input type="submit" name="addNewProduct" class="btn btn-success float-right btn-margin" value="&#10003; Skapa ny">


  </form>
  <form action="../index.php">
    <input type="submit" class="btn btn-secondary float-left btn-margin" value="&#x2190; Tillbaka">
  </form>
</div>




<?php include('../layout/footer.php'); ?>