<?php
require('../../src/config.php');

echo "<pre>";
print_r($_POST);   
echo "<pre>";

echo "<pre>";
print_r($_SESSION);   
echo "<pre>";


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
  $cartTotalSum = $_POST['cartTotalSum'];

  $sql = "
    SELECT * FROM users
    WHERE email = :email;
  ";

// FETCH USER IF EXIST
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $user = $stmt->fetch();
  $userId = isset($user['id']) ? $user['id'] : null;




// CREATE USER IF $user DOESN'T EXIST
    if (empty($user)) {
      $sql = "
      INSERT INTO users (first_name, last_name, street, postal_code, city, country, phone, email, password)
      VALUES (:first_name, :last_name, :street, :postal_code, :city, :country, :phone, :email, :password);
      ";


      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':first_name',   $first_name);
      $stmt->bindParam(':last_name',    $last_name);
      $stmt->bindParam(':street',       $street);
      $stmt->bindParam(':postal_code',  $postal_code);
      $stmt->bindParam(':city',         $city);
      $stmt->bindParam(':country',      $country);
      $stmt->bindParam(':phone',        $phone);
      $stmt->bindParam(':email',        $email);
      $stmt->bindParam(':password',     $password);
      $stmt->execute();
      $userId = $pdo->lastInserId();
    }


// CREATE ORDER
      $sql = "
      INSERT INTO orders (first_name, last_name, street, postal_code, city, country, phone, email, password)
      VALUES (:first_name, :last_name, :street, :postal_code, :city, :country, :phone, :email, :password);
      ";


      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':first_name',   $first_name);
      $stmt->bindParam(':last_name',    $last_name);
      $stmt->bindParam(':street',       $street);
      $stmt->bindParam(':postal_code',  $postal_code);
      $stmt->bindParam(':city',         $city);
      $stmt->bindParam(':country',      $country);
      $stmt->bindParam(':phone',        $phone);
      $stmt->bindParam(':email',        $email);
      $stmt->bindParam(':password',     $password);
      $stmt->execute();
      $userId = $pdo->lastInserId();


}

?>