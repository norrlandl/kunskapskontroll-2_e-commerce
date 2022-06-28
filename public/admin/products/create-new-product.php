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
  <form action="../index.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Tillbaka">
  </form>
  </br>
  </br>
  <?= $message ?>
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
<?php include('../layout/footer.php'); ?>