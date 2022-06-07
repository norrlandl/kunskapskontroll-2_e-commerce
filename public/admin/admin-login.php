<?php

    require('../../src/config.php');
    
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
            WHERE email = :email AND password = :password
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {
            // User exists
            $_SESSION['username'] = $user['username'];
            $_SESSION['id']       = $user['id'];
            header('Location: ./index.php');
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

    <!-- Sidans/Dokumentets huvudsakliga innehåll -->
    <div id="content">
        <article class="border">
            <form method="POST" action="#">
                <fieldset>
                    <legend>Logga in</legend>

                    <?=$message ?>
                    
                    <p>
                        <label for="input1">E-post:</label> <br>
                        <input type="text" class="text" name="email">
                    </p>

                    <p>
                        <label for="input2">Lösenord:</label> <br>
                        <input type="password" class="text" name="password">
                    </p>

                    <p>
                        <input type="submit" name="doLogin" value="Login">
                    </p>
                </fieldset>
            </form>
        
            <hr>
        </article>
    </div>
