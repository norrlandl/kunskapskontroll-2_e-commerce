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
  $confirm      = trim($_POST['confirm']);
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

    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':first_name',   $first_name);
    $stmt->bindParam(':last_name',    $last_name);
    $stmt->bindParam(':street',       $street);
    $stmt->bindParam(':postal_code',  $postal_code);
    $stmt->bindParam(':city',         $city);
    $stmt->bindParam(':country',      $country);
    $stmt->bindParam(':phone',        $phone);
    $stmt->bindParam(':email',        $email);
    $stmt->bindParam(':password',     $encryptedPassword);
    $stmt->execute();
    $userId = $pdo->lastInsertId();
  }


  // CREATE ORDER

  echo "<pre>";
  echo "User id ";
  print_r($userId);
  echo "<pre>";


  $sql = "
      INSERT INTO orders 
      (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
      VALUES 
      (:user_id, :total_price, :billing_full_name, :billing_street, :billing_postal_code, :billing_city, :billing_country);
      ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':user_id',              $userId);
  $stmt->bindParam(':total_price',          $cartTotalSum);
  $stmt->bindValue(':billing_full_name',    $first_name . " " . $last_name);
  $stmt->bindParam(':billing_street',       $street);
  $stmt->bindParam(':billing_postal_code',  $postal_code);
  $stmt->bindParam(':billing_city',         $city);
  $stmt->bindParam(':billing_country',      $country);
  $stmt->execute();
  $orderId = $pdo->lastInsertId();


  foreach ($_SESSION['cartItems'] as $item) {

    $sql = "
        INSERT INTO order_items (order_id, product_id, product_title, quantity, unit_price)
        VALUES (:order_id, :product_id, :product_title, :quantity, :unit_price);
        ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':order_id',       $orderId);
    $stmt->bindValue(':product_id',     $item['id']);
    $stmt->bindValue(':product_title',  $item['title']);
    $stmt->bindValue(':quantity',       $item['quantity']);
    $stmt->bindValue(':unit_price',     $item['price']);
    $stmt->execute();
  }
  redirect('order-confirmation.php');
}

// Om inget finns i varukorgen, hoppa tillbaka
redirect('checkout.php');
