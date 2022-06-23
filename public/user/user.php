<?php
require('../../src/config.php');
$pageTitle = "Användare";
$pageId    = "user";

if (!isset($_SESSION['email'])) {
  header("Location: ./user-login.php?mustLogin");
}

/* if (!isset($_SESSION['email'])) {
  $sql = "
  SELECT * FROM users
  WHERE id = :id
  ";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':id', $_SESSION['id']);
  $stmt->execute();
  $user = $stmt->fetch();
  debug($_SESSION['id']);
} */

debug($_SESSION['id']);
debug($_SESSION['email']);
debug($_SESSION['first_name']);


$error = "";
$message = "";

/**
 * FETCH ORDERS 
 */

// $sql = "
//   SELECT * FROM users
//   WHERE id = :id
// ";


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
$stmt->bindParam(':id', $_SESSION['id']);
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
    <table class="table table-user">

      <thead>
        <tr>
          <th scope="col">Ordernummner</th>
          <th scope="col" colspan="3">Datum</th>
          <th scope="col">Mer</th>
        </tr>
      </thead>

      <tbody>

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

    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#updateModal" data-first_name="<?= htmlentities($user['first_name']) ?>" data-last_name="<?= htmlentities($user['last_name']) ?>" data-street="<?= htmlentities($user['street']) ?>" data-city="<?= htmlentities($user['city']) ?>" data-postal_code="<?= htmlentities($user['postal_code']) ?>" data-country="<?= htmlentities($user['country']) ?>" data-email="<?= htmlentities($user['email']) ?>" data-phone="<?= htmlentities($user['phone']) ?>" data-password="<?= htmlentities($user['password']) ?>" data-id="<?= htmlentities($user['id']) ?>">Uppdatera</button>

  </div>

</div>


<!-- MODAL -->
<div id="updateModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  <h4>UPPDATERA - Mina uppgifter</h4>

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uppdatera min uppgifter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="" method="POST">

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_first_name">Förnamn</label>
              <input type="text" class="form-control" name="first_name" value="<?= htmlentities($user['first_name']) ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="cart_last_name">Efternamn</label>
              <input type="text" class="form-control" name="last_name" value="<?= htmlentities($user['last_name']) ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="cart_street">Adress</label>
            <input type="text" class="form-control" name="street" value="<?= htmlentities($user['street']) ?>">
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_city">Stad</label>
              <input type="text" class="form-control" name="city" value="<?= htmlentities($user['city']) ?>">
            </div>
            <div class="form-group col-md-2">
              <label for="cart_postal_code">Zip</label>
              <input type="text" class="form-control" name="postal_code" value="<?= htmlentities($user['postal_code']) ?>">
            </div>
            <div class="form-group col-md-4">
              <label for="cart_country">Land</label>
              <input type="text" class="form-control" name="country" value="<?= htmlentities($user['country']) ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_email">E-post</label>
              <input type="text" class="form-control" name="email" value="<?= htmlentities($user['email']) ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="cart_phone">Telefon</label>
              <input type="text" class="form-control" name="phone" value="<?= htmlentities($user['phone']) ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_passord">Lösenord</label>
              <input type="password" class="form-control" name="password" value="***">
            </div>
            <div class="form-group col-md-6">
              <label for="cart_confirm">Bekräfta lösenord</label>
              <input type="password" class="form-control" name="confirm" value="***">
            </div>
          </div>

          <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
          <input type="submit" name="updateUser" value="Uppdatera konto" class="btn btn-success">

          <div class="modal-footer">
            <input type="submit" name="deleteUser" value="Radera konto" class="btn btn-danger">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

        </form>
      </div>


    </div>
  </div>
</div>


<!-- jQuery Modal -->
<script>
  $('#updateModal').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var first_name = button.data('first_name');
    var last_name = button.data('last_name');
    var street = button.data('street');
    var postal_code = button.data('postal_code');
    var city = button.data('city');
    var country = button.data('country');
    var phone = button.data('phone');
    var email = button.data('email');
    var password = button.data('password');
    var confirm = button.data('confirm');
    var id = button.data('id');

    var modal = $(this)
    modal.find('.modal-body input[name="first_name"]').val(first_name);
    modal.find('.modal-body input[name="last_name"]').val(last_name);
    modal.find('.modal-body input[name="street"]').val(street);
    modal.find('.modal-body input[name="postal_code"]').val(postal_code);
    modal.find('.modal-body input[name="city"]').val(city);
    modal.find('.modal-body input[name="country"]').val(country);
    modal.find('.modal-body input[name="phone"]').val(phone);
    modal.find('.modal-body input[name="password"]').val(password);
    modal.find('.modal-body input[name="confirm"]').val(confirm);
    modal.find('.modal-body input[name="id"]').val(id);
  })
</script>

<!-- Prevent +1(form) on reload page -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>


<?php include('../layout/footer.php'); ?>