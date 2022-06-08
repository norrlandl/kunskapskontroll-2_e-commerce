<?php
    require('../../src/dbconnect.php');
    $pageTitle = "Logga in användare";
    $pageId    = "user-login";

    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";

    $message = "";
    $email = "";

    if (isset($_POST['userLogin'])) {
        $email      = trim($_POST['email']);
        $password   = trim($_POST['password']);

        $sql = "
        SELECT id, email, password FROM users
        WHERE email = :email
        ";
  
        $stmt = $dbconnect->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) { 
            $_SESSION['email']    = $user['email'];
            $_SESSION['id']       = $user['id'];
            header("Location: user.php");
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



<div id="">
  <form method="POST" action="#">
      <?=$message ?>

      <h1>Logga in användare</h1>

      <label for="input1">E-post:</label> <br>
      <input type="text" class="text" name="email" value="<?=htmlentities($email) ?>"> <br>

      <label for="input2">Lösenord:</label> <br>
      <input type="password" class="text" name="password"> <br>
    
      <input type="submit" name="userLogin" value="login">     
  </form>
    <a href="user-register.php"><p>REGISTERA</p></a>
</div>

