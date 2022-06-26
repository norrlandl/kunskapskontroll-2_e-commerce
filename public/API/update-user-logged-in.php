<?php
require('../../src/config.php');

$error = "";
$user = $globalDbHandler->fetchById($_SESSION['id'], "users");

if (isset($_POST["updateUser"])) {

  $firstName = trim($_POST["first_name"]);
  $lastName = trim($_POST["last_name"]);
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $phone = trim($_POST["phone"]);
  $street = trim($_POST["street"]);
  $postalCode = trim($_POST["postal_code"]);
  $city = trim($_POST["city"]);
  $country = trim($_POST["country"]);

  if (empty($firstName)) {
    $error .= "<li>Förnamn är obligatoriskt</li>";
  }

  if (empty($lastName)) {
    $error .= "<li>Efternamn är obligatoriskt</li>";
  }

  if (empty($phone)) {
    $error .= "<li>Mobilnummer är obligatoriskt</li>";
  }

  if (empty($email)) {
    $error .= "<li>E-post är obligatoriskt</li>";
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "<li>Ogiltig e-post</li>";
  }

  if ($error) {
    $message = "
      <div>
          {$error}
      </div>
    ";
  } else {
    if (empty($password)) {
      $userDbHandler->updateUser(
        $_POST['userID'],
        $firstName,
        $lastName,
        $email,
        $user["password"],
        $phone,
        $street,
        $postalCode,
        $city,
        $country
      );
    } else {
      $userDbHandler->updateUser(
        $_POST['userID'],
        $firstName,
        $lastName,
        $email,
        $password,
        $phone,
        $street,
        $postalCode,
        $city,
        $country
      );
    }
  }
}

$data = [
  "error" => $error,
  "first_name" => trim($_POST["first_name"]),
  "last_name" => trim($_POST["last_name"]),
  "email" => trim($_POST["email"]),
  "password" => trim($_POST["password"]),
  "phone" => trim($_POST["phone"]),
  "street" => trim($_POST["street"]),
  "postal_code" => trim($_POST["postal_code"]),
  "city" => trim($_POST["city"]),
  "country" => trim($_POST["country"])
];

echo json_encode($data);
