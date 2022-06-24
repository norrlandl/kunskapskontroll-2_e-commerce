<?php
require('../../../src/config.php');
$pageTitle = "Create new product";

$error = "";
$message = "";

$title = "";
$description = "";
$price = "";
$stock = "";

print_r($_FILES);

if (isset($_POST["addNewProduct"])) {
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $stock = trim($_POST['stock']);

  if (empty($title)) {
    $error .= "Titel är obligatoriskt <br>";
  }

  if (empty($description)) {
    $error .= "Beskrivning är obligatoriskt <br>";
  }

  if (empty($price)) {
    $error .= "Pris är obligatoriskt <br>";
  }

  if (empty($stock)) {
    $error .= "Lagerantal är obligatoriskt <br>";
  }

  if (!is_uploaded_file($_FILES['img_url']['tmp_name'])) {
    $error .= "En bild måste laddas upp";
  }

  if ($error) {
    $message = "
          <div>
              {$error}
          </div>
      ";
  } else {
    if (is_uploaded_file($_FILES['img_url']['tmp_name'])) {
      $fileName         = $_FILES['img_url']['name'];
      $fileType         = $_FILES['img_url']['type'];
      $fileTempPath   = $_FILES['img_url']['tmp_name'];
      $path             = '../../img/';
      $newFilePath = $path . $fileName;
    }

    move_uploaded_file($fileTempPath, $newFilePath);
    $img = $fileName;

    $userDbHandler->addProductToDb(
      trim($_POST["title"]),
      trim($_POST["description"]),
      trim($_POST["price"]),
      $stock = trim($_POST["stock"]),
      $img
    );

    redirect("../index.php");
  }
}
?>

<?php include('../layout/header.php'); ?>
<div class="page-wrapper">
  <form action="../index.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Tillbaka">
  </form>
  <?= $message ?>
  </br>
  </br>
  <form action="" method="POST" class="form-group" enctype="multipart/form-data">
    <input type="text" class="form-control" id="title" name="title" placeholder="Titel" value="<?= htmlentities($title) ?>"><br>
    <textarea rows="6" cols="60" class="form-control" id="description" name="description" placeholder="Beskrivning"><?= htmlentities($description) ?></textarea><br>
    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="price" name="price" placeholder="Pris" value="<?= htmlentities($price) ?>"><br>
    <input type="number" class="form-control" id="stock" name="stock" placeholder="Lagerantal" value="<?= htmlentities($stock) ?>"><br>
    <label for="image">Lägg till bild:</label><br>
    <input type="file" id="image" name="img_url" placeholder="Add image"><br><br>
    <input type="submit" name="addNewProduct" class="btn btn-outline-primary" value="Skapa ny"><br>
  </form>
</div>
<? include('../../layout/footer.php'); ?>