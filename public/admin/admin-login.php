<?php

    require('../../src/config.php');
    
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

        $user = $userDbHandler->fetchUserByEmail($email);
    


        // Tom array => false
        // Icke tim array => true
        if ($user && password_verify($password, $user['password'])) { // password_verify($password, $encryptedPassword);
            // User exists
            $_SESSION['username'] = $user['username'];
            $_SESSION['id']       = $user['id'];
            redirect('users.php');
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
