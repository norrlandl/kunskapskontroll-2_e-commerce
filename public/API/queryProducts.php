<?php
require('../../src/config.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

$productsArray = [];
// if (isset($_GET['productId'])) {
//     // Fetch products
//     $sql = "
//         SELECT * FROM products 
//         WHERE id = :id
//     ";
  
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':id', $_GET['productId']);
//     $stmt->execute();
//     $productsArray = $stmt->fetchAll();
// }


// Fetch puns
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$productsArray = $stmt->fetchAll();

// header('Location: index.php');
// exit;

// Output with JSON
$data = [
    'products' => $productsArray
];

echo json_encode($data);