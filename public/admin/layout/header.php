<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/header.css" />
    <link rel="stylesheet" type="text/css" href="./css/admin.css" />
    <title><?= $pageTitle ?></title>
</head>

<body>

    <header>
        <nav>
            <? if (isset($_SESSION["email"])) {
                echo '<a href="../../public/index.php">Visit page</a> <a href="./admin-logout.php">Log out</a>';
            } else {
                echo '<a href="../../public/index.php">Visit page</a> <a href="#">Log in</a>';
            }
            ?>
        </nav>
    </header>

</body>

</html>