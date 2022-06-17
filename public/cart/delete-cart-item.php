<?php

require('../../src/config.php');

// Kolla så att id följer med
echo "<pre>";
print_r($_POST);
echo "<pre>";


if (isset($_POST['cartId']) && isset($_SESSION['cartItems'][$_POST['cartId']])) {
  unset($_SESSION['cartItems'][$_POST['cartId']]);
}

// Hoppar tillbaka till senaste sidan
header('Locatiton: ' . $_SERVER['HTTP_REFERER']);
exit;


