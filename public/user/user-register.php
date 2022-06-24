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

<main class="main-login-page">
  <div class="page-wrapper-login">
    <h2>Registrera konto</h2>
    <?= $message ?>
    <br><br>
    <form action="" method="POST" class="fm-control">
      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Förnamn" value="<?= htmlentities($first_name) ?>"><br>
      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Efternamn" value="<?= htmlentities($last_name) ?>"><br>
      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= htmlentities($email) ?>"><br>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon" value="<?= htmlentities($phone) ?>"><br>
      <input type="text" class="form-control" id="street" name="street" placeholder="Address" value="<?= htmlentities($street) ?>"><br>
      <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postkod" value="<?= htmlentities($postal_code) ?>"><br>
      <input type="text" class="form-control" id="city" name="city" placeholder="Stad" value="<?= htmlentities($city) ?>"><br>
      <input type="text" class="form-control" id="country" name="country" placeholder="Land" value="<?= htmlentities($country) ?>"><br>
      <input type="password" class="form-control" id="password" name="password" placeholder="Lösenord"><br>
      <input type="password" class="form-control" id="confirmPassword" name="confirm" placeholder="Bekräfta lösenord"><br>
      <input type="submit" name="createUser" class="btn btn-outline-success" value="Registrera konto"><br>
    </form>
  </div>
</main>
<?php include('../layout/footer.php'); ?>