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
<div id="">
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
</div>
<?php include('../layout/footer.php'); ?>