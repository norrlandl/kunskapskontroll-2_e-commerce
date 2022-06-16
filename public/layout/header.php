<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/css/styles.css" />
  <title><?= $pageTitle ?></title>
  <style>
    .admin-nav {
      min-height: 3vh;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: white;
      color: gray;
      padding: 0 1rem;
    }

    .search-bar {
      min-height: 10vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: lightgray;
    }
  </style>
</head>

<body>

  <!--   <header>
    <nav>
      <div class="row">
        <h3 class="link">Shop</h3>
        <a class="link" href="/kunskapskontroll-2_e-commerce/public/index.php">Products</a>
        <p class="link" href="/kunskapskontroll-2_e-commerce/public/index.php">Search</p>
        <a class="link" href="/kunskapskontroll-2_e-commerce/public/user/user-login.php">Login</a>
        <a class="link" href="/kunskapskontroll-2_e-commerce/public/admin/index.php">Admin</a>
      </div>
    </nav>
  </header> -->

  <header class="user-header">
    <div class="admin-nav">
      <p>Fri frakt över 599kr</p>
      <div class="leaving">
        <a href="#">Admin</a> /
        <a href="#">Logga ut</a>
      </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
      <a href="/kunskapskontroll-2_e-commerce/public/index.php" class="navbar-brand">POSTERS</a>
      <a href="/kunskapskontroll-2_e-commerce/public/index.php" class="navbar-brand">LOGGA</a>
      <div class="form-inline">
        <a href="#">Mina sidor</a>
        <a href="#">ICON</a>
      </div>
    </nav>
    <div class="search-bar">
      <form action="">
        <input type="search" value="Sök motiv..." name="search" id="search">
        <button>Logo</button>
      </form>
    </div>
  </header>