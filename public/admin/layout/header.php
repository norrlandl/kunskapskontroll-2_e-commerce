<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/header.css" />
    <link rel=" stylesheet" type="text/css" href="./css/admin.css" />
    <title><?= $pageTitle ?></title>
</head>

<body>
    <header>
        <nav>
            <?php if (isset($_SESSION["email"])) {
                echo '<a href="/kunskapskontroll-2_e-commerce/public/index.php">Visit homepage</a> <a href="./admin-logout.php">Log out</a>';
            } else {
                echo '<a href="/kunskapskontroll-2_e-commerce/public/index.php">Visit homepage</a> <a href="#">Log in</a>';
            }
            ?>
        </nav>
    </header>