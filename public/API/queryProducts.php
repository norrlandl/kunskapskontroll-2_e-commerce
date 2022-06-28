<?php
require('../../src/config.php');

$productsArray = [];

// Fetch products
$sql = "SELECT * FROM products";
$stmt = $pdo->query($sql);
$productsArray = $stmt->fetchAll();

// Output with JSON
$data = [
    'products' => $productsArray
];

echo json_encode($data);