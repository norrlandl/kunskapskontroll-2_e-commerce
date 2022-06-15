<?php
require('../../src/config.php');

$_SESSION = [];
session_destroy();
redirect("./admin-login.php?logout");
exit;

include('../layout/footer.php');
