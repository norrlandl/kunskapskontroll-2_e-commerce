<?php
require('../../src/config.php');
$pageTitle = "Registrera användare";
$pageId    = "user-register";
// checkLoginSession();


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

/**
 * Create user
 */
$error = "";
$message = "";

$first_name = "";
$last_name = "";
$street = "";
$postal_code = "";
$city = "";
$country = "";
$phone = "";
$email = "";
$password = "";

if (isset($_POST['createUser'])) {
  $first_name   = trim($_POST['first_name']);
  $last_name    = trim($_POST['last_name']);
  $street       = trim($_POST['street']);
  $postal_code  = trim($_POST['postal_code']);
  $city         = trim($_POST['city']);
  $country      = trim($_POST['country']);
  $phone        = trim($_POST['phone']);
  $email        = trim($_POST['email']);
  $password     = trim($_POST['password']);
  $confirm      = trim($_POST['confirm']);


  if (trim($_POST["password"]) !== trim($_POST["confirm"])) {
    $message = '
        <div>
            Confirmed password incorrect!
        </div>
    ';
  }

  if (empty($first_name)) {
    //Lägg till bootstrap alerts!
    $error .= '<div class="alert alert-danger">Förnamn är obligatoriskt <br></div>';
  }

  if (empty($last_name)) {
    $error .= "Efternamn är obligatoriskt <br>";
  }

  if (empty($phone)) {
    $error .= "Mobilnummer är obligatoriskt <br>";
  }

  if (empty($email)) {
    $error .= "E-post är obligatoriskt <br>";
  }

  if (empty($password)) {
    $error .= "Du har glömt fylla i lösenord <br>";
  }

  if ($password !== $confirm) {
    $error .= 'Det bekräftade lösenordet måste vara samma som lösenord!';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "Ogiltig e-post <br>";
  }

  if ($error) {
    $message = "
            <div>
                {$error}
            </div>
        ";
  } else {
    try {

      $userDbHandler->addUserToDb(
        $first_name,
        $last_name,
        $email,
        $phone,
        $street,
        $postal_code,
        $city,
        $country,
        $password
      );

      redirect("user-login.php?email=$email");
    } catch (\PDOException $e) {
      if ((int) $e->getCode() === 23000) {
        $message = "
                  <div class='error_msg'>
                      E-post addressen är redan taget. Var snäll ange en annan E-post
                  </div>
              ";
      } else {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
      }
    }
  }
}

?>

<?php include('../layout/header.php'); ?>

<div class="container">

  <div class="row">
    <div class="info">
      <p><b>REGISTRERA KONTO!</b></p>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque.
      </p>
    </div>
  </div>

  <div class="container-small">
    <form action="" method="POST" class="fm-control">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_first_name">Förnamn</label>
          <input type="text" id="first_name" class="form-control" name="first_name" value="<?= htmlentities($first_name) ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_last_name">Efternamn</label>
          <input type="text" id="last_name" class="form-control" name="last_name" value="<?= htmlentities($last_name) ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="cart_street">Adress</label>
        <input type="text" id="street" class="form-control" name="street" value="<?= htmlentities($street) ?>">
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_city">Stad</label>
          <input type="text" id="city" class="form-control" name="city" value="<?= htmlentities($city) ?>">
        </div>
        <div class="form-group col-md-2">
          <label for="cart_postal_code">Zip</label>
          <input type="text" id="postal_code" class="form-control" name="postal_code" value="<?= htmlentities($postal_code) ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="cart_country">Land</label>
          <input type="text" id="country" class="form-control" name="country" value="<?= htmlentities($country) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_email">E-post</label>
          <input type="text" id="email" class="form-control" name="email" value="<?= htmlentities($email) ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_phone">Telefon</label>
          <input type="text" id="phone" class="form-control" name="phone" value="<?= htmlentities($phone) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_passord">Lösenord</label>
          <input type="password" id="password" class="form-control" name="password">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_confirm">Bekräfta lösenord</label>
          <input type="password" id="confirmPassword" class="form-control" name="confirm">
        </div>
      </div>

      <input type="submit" name="createUser" class="btn btn-outline-success" value="Registrera konto">

    </form>
  </div>
</div>


<?php include('../layout/footer.php'); ?>