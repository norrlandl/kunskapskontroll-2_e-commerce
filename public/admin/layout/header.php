<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel=" stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/admin/css/styles.css" />
    <title><?= $pageTitle ?></title>
</head>

<body>
    <header class="admin-header">
        <nav class="navbar navbar-dark bg-admin">
            <a href="/kunskapskontroll-2_e-commerce/public/index.php" class="navbar-brand">Till hemsidan</a>
            <div class="form-inline">
                <?php if (isset($_SESSION["email"])) { ?>
                    <a href="./admin-logout.php">Logga ut</a>
                <?php } else { ?>
                    <a href="#">Logga in</a>
                <?php } ?>
            </div>
        </nav>
    </header>