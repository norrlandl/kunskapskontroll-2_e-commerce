<?php
require('../../src/config.php');

$_SESSION = [];
session_destroy();
redirect("./user-login.php?logout");
exit;

include('../layout/footer.php');
