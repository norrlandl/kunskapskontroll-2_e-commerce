<?php
require('../../../src/config.php');
$pageTitle = "Skapa ny produkt";

$error = "";
$message = "";

$title = "";
$description = "";
$price = "";
$stock = "";

?>

<?php include('../layout/header.php'); ?>

<div class="page-wrapper">

  <h4>Skapa ny produkt</h4>

  <div id="success-msg"></div>
  <div id="error-msg"></div>

  <form action="./create-new-api.php" id="createNewSubmit" method="POST" class="form-group" enctype="multipart/form-data">

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

<script src="./create-new.js"></script>

<?php include('../layout/footer.php'); ?>