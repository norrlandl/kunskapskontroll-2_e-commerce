<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'my-page-3/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'my-page-3/src/'
// define('CSS_PATH', '../public/css/');          // path to "css"-folder
// define('IMG_PATH', 'img/');          // path to "img"-folder

// Include functions and classes
require(SRC_PATH . '/dbconnect.php');
// require(SRC_PATH . '/app/commonFunctions.php');

/* require(SRC_PATH . '/app/UserDbHandler.php');
$userDbHandler = new UserDbHandler($pdo); */
