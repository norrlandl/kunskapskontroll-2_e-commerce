<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/admin/css/header.css" />
    <!--     <link rel=" stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/admin/css/admin.css" /> -->
    <title><?= $pageTitle ?></title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            color: white;
        }

        a:hover {
            color: white;
            text-decoration: none;
        }

        header {
            min-height: 5vh;
        }

        .wrapper {
            width: 1200px;
            margin: 4rem auto;
        }

        .page-wrapper {
            width: 840px;
            margin: 4rem auto;
        }

        .main-login-page {
            min-height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .page-wrapper-login {
            width: 540px;
            margin: 4rem auto;
        }

        .top-buttons {
            display: flex;
            justify-content: space-between;
        }

        h1 {
            text-align: center;
        }

        h2 {
            margin: 1.5rem 0;
        }

        .action {
            display: flex;
        }

        .action form {
            margin-right: 1rem;
        }
    </style>
</head>

<body>
    <header class="admin-header">
        <nav class="navbar navbar-dark bg-dark">
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