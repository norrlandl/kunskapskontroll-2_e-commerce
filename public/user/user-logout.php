<?php
require('../../src/config.php');

$_SESSION = [];
session_destroy();
redirect("./user-login.php?logout");

include('../layout/footer.php');
