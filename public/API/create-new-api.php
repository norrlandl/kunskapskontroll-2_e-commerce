<?php

require('../../src/config.php');

$error = "";
$img = "";

if (isset($_POST["addNewProduct"])) {
  $title = trim($_POST['title']);
  $description = trim($_POST['description']);
  $price = trim($_POST['price']);
  $stock = trim($_POST['stock']);

  if (empty($title)) {
    $error .= "<li>Titel är obligatoriskt</li>";
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
    <div>
        {$error}
    </div>
  ";
  } else {
    if (is_uploaded_file($_FILES['img_url']['tmp_name'])) {
      $fileName         = $_FILES['img_url']['name'];
      $fileType         = $_FILES['img_url']['type'];
      $fileTempPath   = $_FILES['img_url']['tmp_name'];
      $path             = '../img/';
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
    }
  }
}

$data = [
  "error" => $error,
  "title" => trim($_POST["title"]),
  "description" => trim($_POST["description"]),
  "price" => trim($_POST["price"]),
  "stock" => trim($_POST["stock"]),
  "img" => $img
];

echo json_encode($data);
