<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="/kunskapskontroll-2_e-commerce/public/css/styles.css?v=<?php echo time(); ?>">

  <style>

/* FRAME.CSS */

#Frames,
.Frame {
  list-style: none;
  list-style-type: none;
  margin: 0px;
  padding: 0px;
  text-align: center;
}
#Frames {
  /* margin: 5% 0; */
  margin: 0 0 20px 0;
  width: 100%;
}
.Frame {
  display: inline-block;
  padding: 18px;
  border-width: 7px;
  border-style: solid;
  border-color: #2f2d2d #434040 #4f4c4c #434040;
  background: #f5f5f5;
  background-image: -webkit-gradient(
    linear,
    0 0,
    0 100%,
    from(#e5e4df),
    to(#cdcdc6)
  );
  background-image: -webkit-linear-gradient(#e5e4df, #cdcdc6);
  background-image: -moz-linear-gradient(#e5e4df, #cdcdc6);
  background-image: -o-linear-gradient(#e5e4df, #cdcdc6);
  background-image: linear-gradient(#e5e4df, #cdcdc6);
  box-shadow: inset 0 2px 3px rgba(0, 0, 0, 0.6), 0 3px 2px rgba(0, 0, 0, 0.1),
    0 3px 8px rgba(0, 0, 0, 0.8);
  position: relative;
  overflow: hidden;
}
.Frame::before {
  content: "";
  position: absolute;
  top: -175px;
  right: -20%;
  width: 400px;
  height: 400px;
  transform: rotateZ(-40deg);
  -webkit-transform: rotateZ(-40deg);
  -moz-transform: rotateZ(-40deg);
  -o-transform: rotateZ(-40deg);
  background-image: -webkit-gradient(
    linear,
    0 0,
    0 100%,
    from(rgba(255, 255, 255, 0.4)),
    to(rgba(255, 255, 255, 0))
  );
  background-image: -webkit-linear-gradient(
    rgba(255, 255, 255, 0.4),
    rgba(255, 255, 255, 0)
  );
  background-image: -moz-linear-gradient(
    rgba(255, 255, 255, 0.4),
    rgba(255, 255, 255, 0)
  );
  background-image: -o-linear-gradient(
    rgba(255, 255, 255, 0.4),
    rgba(255, 255, 255, 0)
  );
  background-image: linear-gradient(
    rgba(255, 255, 255, 0.4),
    rgba(255, 255, 255, 0)
  );
}
.Frame img {
  border-width: 2px;
  border-style: solid;
  border-color: #bbbab4 #c7c7bf #e5e4df #c7c7bf;
  box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.1),
    0 1px 1px 1px rgba(255, 255, 255, 0.7);

  width: 162px;
  height: 230px;
  object-fit: cover;
}

/* PRODUCTS.CSS */

* {
  margin: 0;
  padding: 0;
}

.row {
  display: flex;
  flex-direction: row;
  justify-content: center;

}

.wrapping {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  /* justify-content: space-between; */
}

.product {
  display: flex;
  flex-direction: column;

  flex-basis: 215px;
	flex-grow: 0;
	flex-shrink: 0;

  margin: 0px 30px 90px;
  /* background-color: red; */
  text-align: center;
  font-size: 12px;
}

.product-title {
font-weight: 600;
font-size: 14px;
line-height: normal;
}




/* INDEX */

.container {
  /* background-color: grey; */
}


.info {
  /* background-color: green; */
  margin: 90px 0px;
  width: 500px;
  text-align: center;
  font-size: 12px;
}


/* PRODUCT */

.product-singel {
  display: flex;
  flex-direction: row;
  /* background-color: green; */
}

.product-image {
  flex-basis: 45%;
	flex-grow: 0;
	flex-shrink: 0;
  /* background-color: red;  */
}

.product-text {
  padding: 100px 60px 0 60px;
}

.product-image img {
  width: 330px;
  height: 450px;

}

.product-image .Frame {
  padding: 28px;
  border-width: 10px;
}

.stock {
  color: #c6c6c6;
  margin-bottom: 80px;
}

  <!-- STYLING CONTINUE -->
    
    
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


  <header>



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