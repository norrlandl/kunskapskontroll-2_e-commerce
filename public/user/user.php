<?php
require('../../src/config.php');
$pageTitle = "Användare";
$pageId    = "user";

if (!isset($_SESSION['email'])) {
  header("Location: ./user-login.php?mustLogin");
}

$error = "";
$message = "";

// Lägg till FETCH ORDERS!

$user = $globalDbHandler->fetchById($_SESSION['id'], "users");

if (isset($_POST['deleteUser'])) {

  $globalDbHandler->deleteFromDb($user["id"], "users");
  redirect("user-login.php?userDeleted");
}

?>

<?php include('../layout/header.php'); ?>

<?php ?>

<?= $message ?>

<div class="container">
  <div class="row">
    <div class="info">
      <p><b>Välkommen <?= ucfirst($user['first_name']) ?>!</b></p>

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

    <form action="" id="init-form">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_first_name">Förnamn</label>
          <input type="text" id="first_name" readonly class="form-control" name="first_name" value="<?= htmlentities($user['first_name']) ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_last_name">Efternamn</label>
          <input type="text" id="last_name" readonly class="form-control" name="last_name" value="<?= htmlentities($user['last_name']) ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="cart_street">Adress</label>
        <input type="text" id="street" readonly class="form-control" name="street" value="<?= htmlentities($user['street']) ?>">
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_city">Stad</label>
          <input type="text" id="city" readonly class="form-control" name="city" value="<?= htmlentities($user['city']) ?>">
        </div>
        <div class="form-group col-md-2">
          <label for="cart_postal_code">Zip</label>
          <input type="text" id="postal_code" readonly class="form-control" name="postal_code" value="<?= htmlentities($user['postal_code']) ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="cart_country">Land</label>
          <input type="text" id="country" readonly class="form-control" name="country" value="<?= htmlentities($user['country']) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_email">E-post</label>
          <input type="text" id="email" readonly class="form-control" name="email" value="<?= htmlentities($user['email']) ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="cart_phone">Telefon</label>
          <input type="text" id="phone" readonly class="form-control" name="phone" value="<?= htmlentities($user['phone']) ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cart_passord">Lösenord</label>
          <input type="password" readonly class="form-control" name="password" value="***">
        </div>
        <!--       <div class="form-group col-md-6">
        <label for="cart_confirm">Bekräfta lösenord</label>
        <input type="password" readonly class="form-control" name="confirm" value="***">
      </div> -->
      </div>

      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#updateModal" data-first_name="<?= htmlentities($user['first_name']) ?>" data-last_name="<?= htmlentities($user['last_name']) ?>" data-street="<?= htmlentities($user['street']) ?>" data-city="<?= htmlentities($user['city']) ?>" data-postal_code="<?= htmlentities($user['postal_code']) ?>" data-country="<?= htmlentities($user['country']) ?>" data-email="<?= htmlentities($user['email']) ?>" data-phone="<?= htmlentities($user['phone']) ?>" data-password="<?= htmlentities($user['password']) ?>" data-id="<?= htmlentities($user['id']) ?>">
        Ändra uppgifter
      </button>
    </form>
  </div>

</div>


<!-- MODAL -->
<div id="updateModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <br>
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uppdatera min uppgifter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div id="success-message"></div>
        <div id="error-message"></div>
        <form id="modal-user-form" action="../API/update-user-logged-in.php" method="POST">
          <!-- <div id="error-message"></div> -->

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_first_name">Förnamn</label>
              <input type="text" class="form-control" id="modal-first-name" name="first_name" value="<?= htmlentities($user['first_name']) ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="cart_last_name">Efternamn</label>
              <input type="text" class="form-control" id="modal-last-name" name="last_name" value="<?= htmlentities($user['last_name']) ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="cart_street">Adress</label>
            <input type="text" class="form-control" id="modal-street" name="street" value="<?= htmlentities($user['street']) ?>">
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_city">Stad</label>
              <input type="text" class="form-control" id="modal-city" name="city" value="<?= htmlentities($user['city']) ?>">
            </div>
            <div class="form-group col-md-2">
              <label for="cart_postal_code">Zip</label>
              <input type="text" class="form-control" id="modal-postal-code" name="postal_code" value="<?= htmlentities($user['postal_code']) ?>">
            </div>
            <div class="form-group col-md-4">
              <label for="cart_country">Land</label>
              <input type="text" class="form-control" id="modal-country" name="country" value="<?= htmlentities($user['country']) ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_email">E-post</label>
              <input type="text" class="form-control" id="modal-email" name="email" value="<?= htmlentities($user['email']) ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="cart_phone">Telefon</label>
              <input type="text" class="form-control" id="modal-phone" name="phone" value="<?= htmlentities($user['phone']) ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cart_passord">Lösenord</label>
              <input type="password" class="form-control" name="password" placeholder="***">
            </div>
          </div>

          <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
          <input type="submit" name="updateUser" id="user-modal-exit" value="Uppdatera konto" class="btn btn-success">

        </form>
        <div class="modal-footer">
          <form action="" method="POST">
            <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
            <input type="submit" name="deleteUser" value="Radera konto" class="btn btn-danger">
            <button type="button" id="modal-close-btn" class="btn btn-secondary" data-dismiss="modal">Gå tillbaka</button>
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

  function closeModalOnSucess() {
    $('#updateModal').modal('hide');
  }
</script>
<script src="../js/update-user-logged-in.js"></script>

<!-- Prevent +1(form) on reload page -->
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>


<?php include('../layout/footer.php'); ?>