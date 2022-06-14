<?php
require('../../src/config.php');

$pageTitle = "Admin login";

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
<div id="content" class="wrapper">
    <form method="POST" action="#">
        <h2>Log in</h2>
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
                <label class="form-label" for="input2">Password</label>
                <input type="password" id="input2" name="password" class="form-control" />
            </div>

            <!-- Submit button -->
            <button type="submit" name="doLogin" class="btn btn-primary btn-block mb-4">Sign in</button>
    </form>
</div>
<?php include('../layout/footer.php'); ?>