<?php
require('../../src/config.php');
$pageTitle = "Logga in användare";
$pageId    = "user-login";

$message = "";
$email = "";

if (isset($_GET['mustLogin'])) {
    $message = '
    <div class="alert alert-info">
       Sidan är inloggningsskyddad. Var snäll och logga in.
    </div>
    ';
}

if (isset($_GET['logout'])) {
    $message = '
    <div class="alert alert-success">
        Du är nu utloggad.
    </div>
        ';
}

if (isset($_GET["userDeleted"])) {
    $_SESSION = [];
    session_destroy();

    $message = '
    <div class="alert alert-success">
        Du har nu raderat ditt konto.
    </div>
    ';
}

if (isset($_GET["newAccount"])) {
    $message = '
    <div class="alert alert-success">
        Du har skapat ett nytt konto. Vänligen logga in.
    </div>
    ';
}

if (isset($_POST['userLogin'])) {
    $email      = trim($_POST['email']);
    $password   = trim($_POST['password']);

    $user = $userDbHandler->fetchUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        //funktion eller klass nedan
        $_SESSION['email']            = $user['email'];
        $_SESSION['id']               = $user['id'];
        $_SESSION['first_name']       = $user['first_name'];
        header("Location: user.php");
        exit;
    } else {
        $message = '
        <div class="alert alert-danger">
            Fel inloggningsuppgifter. Försök igen!
        </div>
            ';
    }
}
?>


<?php include('../layout/header.php'); ?>
<main class="main-login-page">
    <div class="page-wrapper-login">
        <div id="content">
            <form method="POST" action="#">
                <h2>Logga in</h2>
                <br>
                <?= $message ?>
                <br>

                <div class="form-outline mb-4">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="input1">Email:</label>
                        <input type="text" id="input1" name="email" class="form-control" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="input2">Lösenord:</label>
                        <input type="password" id="input2" name="password" class="form-control" />
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="userLogin" value="login" class="btn btn-primary btn-block mb-4">Logga in</button>

                    <!-- Register -->
                    <div class="form-outline mb-4">
                        <p>Inget konto? <a href="user-register.php">Registrera dig</a></p>
                    </div>
            </form>
        </div>
    </div>
</main>
<?php include('../layout/footer.php'); ?>