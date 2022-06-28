<?php

require('../../src/config.php');

if (isset($_GET['cartId']) && isset($_SESSION['cartItems'][$_GET['cartId']])) {
  unset($_SESSION['cartItems'][$_GET['cartId']]);
}
