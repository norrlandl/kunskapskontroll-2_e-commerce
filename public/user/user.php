<?php
require('../../src/config.php');
$pageTitle = "Användare";
$pageId    = "user";

/* if (!isset($_SESSION['email'])) {
   header("Location: ./user-login.php?mustLogin");
} */

$message = "";

/**
 * UPDATE 
 */

if (isset($_POST["updateUser"])) {
   if (trim($_POST["password"]) !== trim($_POST["confirm"])) {
      $message .= '
          <div>
              Confirmed password incorrect!
          </div>
      ';
   } else {
      $userDbHandler->updateUser(
         $firstName = trim($_POST["first_name"]),
         $lastName = trim($_POST["last_name"]),
         $email = trim($_POST["email"]),
         $password = trim($_POST["password"]),
         $phone = trim($_POST["phone"]),
         $street = trim($_POST["street"]),
         $postalCode = trim($_POST["postal_code"]),
         $city = trim($_POST["city"]),
         $country = trim($_POST["country"])
      );
   }
}

   // if ($password !== $confirm) {
   //    $message .= '
   //        <div>
   //            Confirmed password incorrect!
   //        </div>
   //    ';
   // } else {

   //    $sql = "
   // UPDATE users 
   // SET 
   // first_name  = :first_name, 
   // last_name   = :last_name, 
   // street      = :street, 
   // postal_code = :postal_code, 
   // city        = :city, 
   // country     = :country, 
   // phone       = :phone, 
   // email       = :email, 
   // password    = :password,
   // WHERE id = :id";


   //    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

   //    $stmt = $pdo->prepare($sql);
   //    $stmt->bindParam(":id", $_POST['userID']);
   //    $stmt->bindParam(':first_name',   $first_name);
   //    $stmt->bindParam(':last_name',    $last_name);
   //    $stmt->bindParam(':street',       $street);
   //    $stmt->bindParam(':postal_code',  $postal_code);
   //    $stmt->bindParam(':city',         $city);
   //    $stmt->bindParam(':country',      $country);
   //    $stmt->bindParam(':phone',        $phone);
   //    $stmt->bindParam(':email',        $email);
   //    $stmt->bindParam(':password',     $encryptedPassword);
   //    // $stmt->execute();
   // }


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

   header("Location: user-login.php");
}


/**
 * FETCH 
 */
$sql = "
   SELECT * FROM users
   ";
   
$stmt = $pdo->query($sql);
$user = $stmt->fetch();


?>

<?php include('../layout/header.php'); ?>
<h1>Välkommen <?= htmlentities($user['first_name']) ?></h1>

<?php ?>

<?= $message ?>

<h4>Mina uppgifter</h4>

<form method="POST" action="">
   <label for="input">Förnamn:</label> <br>
   <input type="text" class="text" name="first_name" value="<?= htmlentities($user['first_name']) ?>"> <br>

   <label for="input">Efternamn:</label> <br>
   <input type="text" class="text" name="last_name" value="<?= htmlentities($user['last_name']) ?>"> <br>

   <label for="input">Adress:</label> <br>
   <input type="text" class="text" name="street" value="<?= htmlentities($user['street']) ?>"> <br>

   <label for="input">Postkod:</label> <br>
   <input type="text" class="text" name="postal_code" value="<?= htmlentities($user['postal_code']) ?>"> <br>

   <label for="input">Stad:</label> <br>
   <input type="text" class="text" name="city" value="<?= htmlentities($user['city']) ?>"> <br>

   <label for="input">Land:</label> <br>
   <input type="text" class="text" name="country" value="<?= htmlentities($user['country']) ?>"> <br>

   <label for="input">Telefon:</label> <br>
   <input type="text" class="text" name="phone" value="<?= htmlentities($user['phone']) ?>"> <br>

   <label for="input">Email:</label> <br>
   <input type="text" class="text" name="email" value="<?= htmlentities($user['email']) ?>"> <br>

   <label for="input">Lösenord:</label> <br>
   <input type="password" class="text" name="password"> <br>

   <label for="input">Upprepa lösenord:</label> <br>
   <input type="password" class="text" name="confirm"> <br> <br>

   <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
   <input type="submit" name="updateUser" value="Uppdatera konto">
</form>

<!-- <h4>Tidigare ordrar</h4> -->
<form method="POST" action="">
   <input type="hidden" name="userID" value="<?= htmlentities($user['id']) ?>">
   <input type="submit" name="deleteUser" value="Radera konto">
</form>
<?php include('../layout/footer.php'); ?>