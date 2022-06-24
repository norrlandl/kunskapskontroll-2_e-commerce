<?php
require('../../src/config.php');

$pageTitle = "Logga in admin";

$message = "";

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

if (isset($_GET["userDeleted"])) {
    $_SESSION = [];
    session_destroy();

    $message = '
    <div class="success_msg">
        Du har nu raderat ditt konto.
    </div>
    ';
}

if (isset($_GET["tableDeleted"])) {
    $_SESSION = [];
    session_destroy();

    $message = '
    <div class="success_msg">
        Du har nu raderat alla användare.
    </div>
    ';
}

if (isset($_POST['doLogin'])) {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "
            SELECT * FROM users
            WHERE email = :email
        ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION['email']    = $user['email'];
        $_SESSION['id']       = $user['id'];
        $_SESSION['first_name']       = $user['first_name'];
        header("Location: index.php");
        exit;
    } else {
        $message = '
                <div class="error_msg">
                    Fel inloggningsuppgifter. Försök igen!
                </div>
            ';
    }
}
?>

<?php include('./layout/header.php'); ?>
<main class="main-login-page">
    <div class="page-wrapper-login">
        <div id="content">
            <form method="POST" action="#">
                <h2>Logga in</h2>
                <?= $message ?>
                <br><br>

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
                    <button type="submit" name="doLogin" class="btn btn-primary btn-block mb-4">Logga in</button>
            </form>
        </div>
    </div>
</main>
<?php include('../layout/footer.php'); ?>