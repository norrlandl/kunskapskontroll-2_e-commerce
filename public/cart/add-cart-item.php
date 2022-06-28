<?php
require('../../src/config.php');

if (!empty($_GET['quantity'])) {

  $productId  = (int) $_GET['productId'];
  $quantity   = (int) $_GET['quantity'];

  $product = $globalDbHandler->fetchById($productId, "products");


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
  }
}