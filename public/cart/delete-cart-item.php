<?php

require('../../src/config.php');

if (isset($_POST['cartId']) && isset($_SESSION['cartItems'][$_POST['cartId']])) {
  unset($_SESSION['cartItems'][$_POST['cartId']]);
}

// Hoppar tillbaka till senaste sidan
if (!empty($_SERVER['HTTP_REFERER'])) {
  header("Location: " . $_SERVER['HTTP_REFERER']);
}
