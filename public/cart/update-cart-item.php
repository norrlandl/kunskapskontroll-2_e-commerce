<?php

require('../../src/config.php');

// Kolla så att id följer med
// echo "<pre>";
// print_r($_GET);
// echo "<pre>";

if (
  isset($_GET['cartId'])
  && !empty($_GET['quantity'])
  && isset($_SESSION['cartItems'][$_GET['cartId']])
) {
  $_SESSION['cartItems'][$_GET['cartId']]['quantity'] = $_GET['quantity'];
}

// Hoppar tillbaka till senaste sidan
// if (!empty($_SERVER['HTTP_REFERER'])) {
//   header("Location: " . $_SERVER['HTTP_REFERER']);
// }
