<?





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/css/styles.css?v=<?php echo time(); ?>">
</head>

<body>
  <header class="user-header">

    <div class="admin-container">
      <span>
        <i>Fri frakt över 599kr!</i>
      </span>
      <div class="admin-nav">
        <a href="/kunskapskontroll-2_e-commerce/public/admin/index.php">Admin</a>
        <?php if (isset($_SESSION["email"])) { ?>
          <a href="/kunskapskontroll-2_e-commerce/public/user/user-logout.php">Logga ut</a>
        <?php } else { ?>
          <div></div>
        <?php } ?>
      </div>
    </div>
    <nav id="main-nav" class="navbar navbar-expand-md navbar-dark main-nav">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a href="/kunskapskontroll-2_e-commerce/public/index.php" class="navbar-brand order-first order-md-0 mx-0" href="#"><img class="logo" src="/kunskapskontroll-2_e-commerce/public/img/logo.png" width="50px" height="50px" alt="logga"></a>
        <div class="collapse navbar-collapse w-100">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item">
              <?php if (isset($_SESSION["email"])) { ?>
                <span class="log-out-link"><a href="/kunskapskontroll-2_e-commerce/public/user/user.php"><?= $_SESSION['first_name'] ?></a></span>
              <?php } else { ?>
                <a href="/kunskapskontroll-2_e-commerce/public/user/user.php">
                  <i class="fa fa-user fa-lg user-icon"></i>
                </a>
              <?php } ?>
            </li>
            <?php include(ROOT_PATH . 'public/cart/cart.php'); ?>
          </ul>

        </div>
      </div>
    </nav>
    <div class="search-bar">
      <form id="search-form" action="#">
        <div class="input-group search-absolute mb-4 p-1">
          <input id="searchInput" type="search" placeholder="Sök motiv..." aria-describedby="button-addon3" class="form-control bg-none border-0  rounded-pill" autocomplete="off">
          <!-- <div class="input-group-append border-0">
            <button id="button-addon3" type="button" class="btn btn-links"><i class="fa fa-search"></i></button>
          </div> -->
          <div id="searchResults" class="search-results-container"></div>
        </div>
      </form>
    </div>
  </header>