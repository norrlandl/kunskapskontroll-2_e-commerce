<?php

require('../../src/config.php');

// Kolla så att id följer med
echo "<pre>";
print_r($_POST);
echo "<pre>";


if (
  isset($_POST['cartId'])
  && !empty($_POST['quantity'])
  && isset($_SESSION['cartItems'][$_POST['cartId']])
) {
  $_SESSION['cartItems'][$_POST['cartId']]['quantity'] = $_POST['quantity'];
}

// Hoppar tillbaka till senaste sidan
if (!empty($_SERVER['HTTP_REFERER'])) {
  header("Location: " . $_SERVER['HTTP_REFERER']);
}
