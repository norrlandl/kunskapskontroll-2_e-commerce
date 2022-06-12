<?
require('../../src/config.php');

$_SESSION = [];
session_destroy();
header("Location: ./admin-login.php?logout");
exit;

include('../layout/footer.php');
