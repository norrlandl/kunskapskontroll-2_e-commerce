<?php
require('../../src/config.php');
$pageTitle = "Logga in användare";
$pageId    = "user-login";

// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

$message = "";
$email = "";

if (isset($_GET['mustLogin'])) {
    $message = '
        <div class="error_msg">
            Sidan är inloggningsskyddad. Var snäll och logga in.
        </div>
    ';
}

if (isset($_GET['logout'])) {
    $message = '
            <div class="success_msg">
                Du är nu utloggad.
            </div>
        ';
}

if (isset($_POST['userLogin'])) {
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);

    $sql = "
        SELECT id, email, password FROM users
        WHERE email = :email
        ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();

    debug($user);
    debug($email);
    debug($password);
    debug($sql);

    if ($user && password_verify($password, $user['password'])) {
        //funktion eller klass nedan
        $_SESSION['email']    = $user['email'];
        $_SESSION['id']       = $user['id'];
        header("Location: user.php?userID=" . $user['id']);
        exit;
    } else {
        $message = '
                <div>
                    Fel inloggningsuppgifter...
                </div>
            ';
    }
}
?>


<?php include('../layout/header.php'); ?>
<!-- <div id="">
    <form method="POST" action="#">
        <?= $message ?>

        <h1>Logga in användare</h1>

        <label for="input1">E-post:</label> <br>
        <input type="text" class="text" name="email" value="<?= htmlentities($email) ?>"> <br>

        <label for="input2">Lösenord:</label> <br>
        <input type="password" class="text" name="password"> <br>

        <input type="submit" name="userLogin" value="login">
    </form>
    <a href="user-register.php">
        <p>REGISTERA</p>
    </a>
</div> -->
<form>
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="form2Example1" class="form-control" />
    <label class="form-label" for="form2Example1">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" class="form-control" />
    <label class="form-label" for="form2Example2">Password</label>
  </div>

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
        <label class="form-check-label" for="form2Example31"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password?</a>
    </div>
  </div>

  <!-- Submit button -->
  <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="#!">Register</a></p>
    <p>or sign up with:</p>
    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button type="button" class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>
<?php include('../layout/footer.php'); ?>