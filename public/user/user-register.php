<?php
  require('../../src/dbconnect.php');
  $pageTitle = "Registrera användare";
  $pageId    = "user-register";
  // checkLoginSession();


  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";

   /**
     * Create user
     */
     $error = "";
     $message = "";

     $first_name = "";
     $last_name = "";
     $street = "";
     $postal_code = "";
     $city = "";
     $country = "";
     $phone = "";
     $email = "";
     $password = "";

     if (isset($_POST['createUser'])) {
      $first_name   = trim($_POST['first_name']);
      $last_name    = trim($_POST['last_name']);
      $street       = trim($_POST['street']);
      $postal_code  = trim($_POST['postal_code']);
      $city         = trim($_POST['city']);
      $country      = trim($_POST['country']);
      $phone        = trim($_POST['phone']);
      $email        = trim($_POST['email']);
      $password     = trim($_POST['password']);
      $confirm      = trim($_POST['confirm']);

      if (empty($first_name)) {
        $error .= "Förnamn är obligatoriskt <br>";
      }

      if (empty($last_name)) {
        $error .= "Efternamn är obligatoriskt <br>";
      }

      if (empty($phone)) {
        $error .= "Mobilnummer är obligatoriskt <br>";
      }

      if (empty($email)) {
        $error .= "E-post är obligatoriskt <br>";
      }

      if (empty($password)) {
        $error .= "Du har glömt fylla i lösenord <br>";
      }

      if ($password !== $confirm) {
        $error .= 'Det bekräftade lösenordet måste vara samma som lösenord!';
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "Ogiltig e-post <br>";
      }

      if ($error) {
        $message = "
            <div>
                {$error}
            </div>
        ";
      } else {

        try {

    // public function addUser(
    //    $first_name, 
    //    $last_name, 
    //    $street, 
    //    $postal_code,
    //    $city,
    //    $country,
    //    $phone,
    //    $email, 
    //    $password
    //    ){
       $sql = "
       INSERT INTO users (first_name, last_name, street, postal_code, city, country, phone, email, password)
       VALUES (:first_name, :last_name, :street, :postal_code, :city, :country, :phone, :email, :password);
    ";

      $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
      // $stmt = $this->$dbconnect->prepare($sql);
      $stmt = $dbconnect->prepare($sql);
      $stmt->bindParam(':first_name',   $first_name);
      $stmt->bindParam(':last_name',    $last_name);
      $stmt->bindParam(':street',       $street);
      $stmt->bindParam(':postal_code',  $postal_code);
      $stmt->bindParam(':city',         $city);
      $stmt->bindParam(':country',      $country);
      $stmt->bindParam(':phone',        $phone);
      $stmt->bindParam(':email',        $email);
      $stmt->bindParam(':password',     $encryptedPassword);
      $stmt->execute();

      header("Location: user-login.php?email=$email");

        } catch (\PDOException $e) {
          if ((int) $e->getCode() === 23000) {
              $message = "
                  <div class='error_msg'>
                      E-post addressen är redan taget. Var snäll ange en annan E-post
                  </div>
              ";
          } else {
              throw new \PDOException($e->getMessage(), (int) $e->getCode());
          }
      }

    }
  }

?>

<?php include('../layout/header.php'); ?>
  <div id="content">
    <form method="POST" action="#">
      <?=$message ?>
    
      <label for="input">Förnamn:*</label> <br>
      <input type="text" class="text" name="first_name" value="<?=htmlentities($first_name) ?>">   <br>

      <label for="input">Efternamn:*</label> <br>
      <input type="text" class="text" name="last_name" value="<?=htmlentities($last_name) ?>">  <br>
      
      <label for="input">Adress:</label> <br>
      <input type="text" class="text" name="street" value="<?=htmlentities($street) ?>">  <br>

      <label for="input">Postkod:</label> <br>
      <input type="text" class="text" name="postal_code" value="<?=htmlentities($postal_code) ?>">  <br>

      <label for="input">Stad:</label> <br>
      <input type="text" class="text" name="city" value="<?=htmlentities($city) ?>">  <br>

      <label for="input">Land:</label> <br>
      <input type="text" class="text" name="country" value="<?=htmlentities($country) ?>">  <br>
      
      <label for="input">Telefon:*</label> <br>
      <input type="text" class="text" name="phone" value="<?=htmlentities($phone) ?>">  <br>

      <label for="input">Email:*</label> <br>
      <input type="text" class="text" name="email" value="<?=htmlentities($email) ?>">  <br>

      <label for="input">Lösenord:</label> <br>
      <input type="password" class="text" name="password">  <br>
      
      <label for="input">Bekräfta lösenordet:</label> <br>
      <input type="password" class="text" name="confirm">  <br>

      <input type="submit" name="createUser" value="Registrera">

    </form>
  </div>
<?php include('../layout/footer.php'); ?>