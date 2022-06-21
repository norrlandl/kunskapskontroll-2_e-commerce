<?php
require('../../src/config.php');


// echo "<pre>";
// print_r($_POST);
// echo "<pre>";


if (!empty($_POST['quantity'])) {

  $productId  = (int) $_POST['productId'];
  $quantity   = (int) $_POST['quantity'];

  $sql = "
    SELECT * FROM products
    WHERE id = :id;
  ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindparam(':id', $productId);
  $stmt->execute();
  $product = $stmt->fetch();


  if ($product) {

    $product = array_merge($product, ['quantity' => $quantity]);

    // ändrar om så den unika nyckeln ligger innan arrayen
    $cartItem = [$productId => $product];


    if (empty($_SESSION['cartItems'])) {
      $_SESSION['cartItems'] = $cartItem;
    } else {
      // checka om varan redan finns i varukorgen
      if (isset($_SESSION['cartItems'][$productId])) {
        // om varan redan finns i varukorgen, uppdatera endast kvantiteten
        $_SESSION['cartItems'][$productId]['quantity'] += $quantity;
      } else {
        // om varan inte finns i varukorgen, lägg till den
        $_SESSION['cartItems'] += $cartItem;
      }
    }

    // echo "<pre>";
    // print_r($cartItem)      // kolla om det funkar att lägga till flera saker i varukorgen
    // echo "<pre>";

  }
}


// Hoppar tillbaka till senaste sidan
if (!empty($_SERVER['HTTP_REFERER'])) {
  header("Location: " . $_SERVER['HTTP_REFERER']);
} 
// else
// print "<br> referpage:" . $_SERVER['HTTP_REFERER'];

// Funkar ej
// header('Locatiton: ' . $_SERVER['HTTP_REFERER']);
// exit;
