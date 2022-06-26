<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', __DIR__ . '/../');
define('SRC_PATH',  __DIR__ . '/');

// Include functions and classes
require(SRC_PATH . '/dbconnect.php');
require(SRC_PATH . '/app/commonFunctions.php');
require(SRC_PATH . '/app/CrudOperations.php');

$userDbHandler = new UserDbHandler($pdo);
$productDbHandler = new ProductDbHandler($pdo);
$orderDbHandler = new OrderDbHandler($pdo);
$globalDbHandler = new GlobalDbHandler($pdo);
