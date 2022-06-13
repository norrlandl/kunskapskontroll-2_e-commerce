<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/admin/css/header.css" />
    <link rel=" stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/admin/css/admin.css" />
    <title><?= $pageTitle ?></title>
</head>

<body>
    <header>
        <nav>
            <?php if (isset($_SESSION["email"])) { ?>
                <a href="/kunskapskontroll-2_e-commerce/public/index.php">Visit homepage</a> <a href="./admin-logout.php">Log out</a>
            <?php } else { ?>
                <a href="/kunskapskontroll-2_e-commerce/public/index.php">Visit homepage</a> <a href="#">Log in</a>
            <?php } ?>
        </nav>
    </header>