<?php

require('../../src/config.php');

$productsArray = [];

// Fetch products
$productsArray = $globalDbHandler->fetchAllFromDb("products");

// Output with JSON
$data = [
    'products' => $productsArray
];

echo json_encode($data);
