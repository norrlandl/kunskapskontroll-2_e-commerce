<?php
require('../../src/config.php');

$cartTotalSum = 0;
$cartTotalItems = 0;

foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
  $cartTotalItems += $cartItem['quantity'];
}

// Output with JSON
$cartData = [
    'totalSum' => $cartTotalSum,
    'totalItems' => $cartTotalItems
];

echo json_encode($cartData);