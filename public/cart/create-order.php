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

  if (empty($first_name)) {
    $error .= "<li>Förnamn är obligatoriskt</li>";
  }

  if (empty($last_name)) {
    $error .= "<li>Efternamn är obligatoriskt</li>";
  }

  if (empty($email)) {
    $error .= "<li>Mejladress är obligatoriskt</li>";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "Ogiltig e-post <br>";
  }

  if (empty($phone)) {
    $error .= "<li>Telefonnummer är obligatoriskt</li>";
  }

  if (empty($street)) {
    $error .= "<li>Address är obligatoriskt</li>";
  }

  if (empty($postal_code)) {
    $error .= "<li>Postkod är obligatoriskt</li>";
  }

  if (empty($city)) {
    $error .= "<li>Stad är obligatoriskt</li>";
  }

  if (empty($password)) {
    $error .= "<li>Lösenord är obligatoriskt</li>";
  }

  if ($password !== $confirm) {
    $error .= '
        <li>
            Lösenorden måste stämma överens med varandra
        </li>
    ';
  }

  if ($error) {
    $_SESSION["errorMessages"] = $message = "
    <ul class='alert alert-danger list-unstyled'>
      $error
    </ul>
      ";

    redirect($_SERVER['HTTP_REFERER']);
  }
  // Skapa en user om inte hen existerar

  else {

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
