<?php
require('../../src/config.php');

if (isset($_POST['createOrderBtn']) && !empty($_SESSION['cartItems'])) {

  $first_name   = trim($_POST['first_name']);
  $last_name    = trim($_POST['last_name']);
  $street       = trim($_POST['street']);
  $postal_code  = trim($_POST['postal_code']);
  $city         = trim($_POST['city']);
  $country      = trim($_POST['country']);
  $phone        = trim($_POST['phone']);
  $email        = trim($_POST['email']);
  $password     = trim($_POST['password']);
  $confirm      = trim($_POST['confirm']);
  $cartTotalSum = $_POST['cartTotalSum'];

  // Hämta user om hen existerar

  $user = $userDbHandler->fetchUserByEmail($email);
  $userId = isset($user['id']) ? $user['id'] : null;

  // Skapa en user om inte hen existerar

  if (empty($user)) {

    $userDbHandler->addUserToDb(
      $first_name,
      $last_name,
      $email,
      $phone,
      $street,
      $postal_code,
      $city,
      $country,
      $password
    );

    $userId = $pdo->lastInsertId();
  }

  // Skapa ny order

  $fullName = $first_name . " " . $last_name;

  $orderDbHandler->createNewOrder(
    $userId,
    $cartTotalSum,
    $fullName,
    $street,
    $postal_code,
    $city,
    $country,
  );

  $orderId = $pdo->lastInsertId();

  foreach ($_SESSION['cartItems'] as $item) {

    $orderDbHandler->createOrderDetails(
      $orderId,
      $item['id'],
      $item['title'],
      $item['quantity'],
      $item['price'],
    );
  }

  redirect("order-confirmation.php");
}

// Om inget finns i varukorgen, hoppa tillbaka
redirect("checkout.php");
