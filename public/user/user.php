<?php
require('../../src/config.php');
$pageTitle = "Användare";
$pageId    = "user";

if (!isset($_SESSION['email'])) {
  header("Location: ./user-login.php?mustLogin");
}

$error = "";
$message = "";

/**
 * UPDATE 
 */

if (isset($_POST["updateUser"])) {
  $firstName = trim($_POST["first_name"]);
  $lastName = trim($_POST["last_name"]);
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);
  $confirm = trim($_POST["confirm"]);
  $phone = trim($_POST["phone"]);
  $street = trim($_POST["street"]);
  $postalCode = trim($_POST["postal_code"]);
  $city = trim($_POST["city"]);
  $country = trim($_POST["country"]);

  if (empty($firstName)) {
    $error .= "Förnamn är obligatoriskt <br>";
  }

  if (empty($lastName)) {
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
    $userDbHandler->updateUser(
      $firstName,
      $lastName,
      $email,
      $password,
      $phone,
      $street,
      $postalCode,
      $city,
      $country
    );
  }
}

/**
 * DELETE 
 */

if (isset($_POST['deleteUser'])) {
  $sql = "
   DELETE FROM users 
   WHERE id = :id";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":id", $_POST['userID']);
  $stmt->execute();

  header("Location: user-login.php ");
}


/**
 * FETCH 
 */
$sql = "
    SELECT * FROM users
    WHERE id = :id
    ";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['userID']);
$stmt->execute();
$user = $stmt->fetch();
?>

<?php include('../layout/header.php'); ?>

<?php ?>

<?= $message ?>

<div class="container">
  <div class="row">
    <div class="info">
      <p><b>Välkommen <?= htmlentities($user['first_name']) ?>!</b></p>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dignissim penatibus felis, nulla sodales arcu ac enim a at. Nibh quisque.
      </p>
    </div>
  </div>

  <div class="container-small">
    <h4>Tidigare ordrar</h4>
    <table class="table table-hover table-user">

      <thead>
        <tr>
          <th scope="col">Ordernummner</th>
          <th scope="col" colspan="3">Datum</th>
          <th scope="col">Mer</th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) :

        ?>

          <tr>
            <th scope="row">#1</th>
            <td colspan="3">
              <p>2022-02-02</p>
            </td>
            <td>
              <button class="btn btn-outline-info">Se detaljer</button>
            </td>
          </tr>
      </tbody>

    <?php endforeach; ?>

    <tfoot>
      <tr>
        <th scope="col"></th>
        <th scope="col" colspan="3"></th>
        <th scope="col"></th>
      </tr>
    </tfoot>

    </table>
  </div>

  <div class="container-small">
    <h4>Mina uppgifter</h4>


    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="cart_first_name">Förnamn</label>
        <input type="text" readonly class="form-control" name="first_name" value="<?= htmlentities($user['first_name']) ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="cart_last_name">Efternamn</label>
        <input type="text" readonly class="form-control" name="last_name" value="<?= htmlentities($user['last_name']) ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="cart_street">Adress</label>
      <input type="text" readonly class="form-control" name="street" value="<?= htmlentities($user['street']) ?>">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="cart_city">Stad</label>
        <input type="text" readonly class="form-control" name="city" value="<?= htmlentities($user['city']) ?>">
      </div>
      <div class="form-group col-md-2">
        <label for="cart_postal_code">Zip</label>
        <input type="text" readonly class="form-control" name="postal_code" value="<?= htmlentities($user['postal_code']) ?>">
      </div>
      <div class="form-group col-md-4">
        <label for="cart_country">Land</label>
        <input type="text" readonly class="form-control" name="country" value="<?= htmlentities($user['country']) ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="cart_email">E-post</label>
        <input type="text" readonly class="form-control" name="email" value="<?= htmlentities($user['email']) ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="cart_phone">Telefon</label>
        <input type="text" readonly class="form-control" name="phone" value="<?= htmlentities($user['phone']) ?>">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="cart_passord">Lösenord</label>
        <input type="password" readonly class="form-control" name="password" value="***">
      </div>
      <div class="form-group col-md-6">
        <label for="cart_confirm">Bekräfta lösenord</label>
        <input type="password" readonly class="form-control" name="confirm" value="***">
      </div>
    </div>

    <button class="btn btn-outline-success">Uppdatera</button>
  </div>


  <div class="container-small">
    <h4>UPPDATERA - Mina uppgifter</h4>

    <form method="POST" action="">
      <label for="input">Förnamn:</label> <br>
      <input type="text" class="text" name="first_name" value="<?= htmlentities($user['first_name']) ?>"> <br>

      <label for="input">Efternamn:</label> <br>
      <input type="text" class="text" name="last_name" value="<?= htmlentities($user['last_name']) ?>"> <br>

      <label for="input">Adress:</label> <br>
      <input type="text" class="text" name="street" value="<?= htmlentities($user['street']) ?>"> <br>

      <label for="input">Postkod:</label> <br>
      <input type="text" class="text" name="postal_code" value="<?= htmlentities($user['postal_code']) ?>"> <br>

      <label for="input">Stad:</label> <br>
      <input type="text" class="text" name="city" value="<?= htmlentities($user['city']) ?>"> <br>

      <label for="input">Land:</label> <br>
      <input type="text" class="text" name="country" value="<?= htmlentities($user['country']) ?>"> <br>

      <label for="input">Telefon:</label> <br>
      <input type="text" class="text" name="phone" value="<?= htmlentities($user['phone']) ?>"> <br>

      <label for="input">Email:</label> <br>
      <input type="text" class="text" name="email" value="<?= htmlentities($user['email']) ?>"> <br>

      <label for="input">Lösenord:</label> <br>
      <input type="password" class="text" name="password"> <br>

      <label for="input">Upprepa lösenord:</label> <br>
      <input type="password" class="text" name="confirm"> <br> <br>

      <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
      <input type="submit" name="updateUser" value="Uppdatera konto">
    </form>

    <!-- <h4>Tidigare ordrar</h4> -->
    <form method="POST" action="">
      <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
      <input type="submit" name="deleteUser" value="Radera konto">
    </form>
  </div>
</div>
<?php include('../layout/footer.php'); ?>