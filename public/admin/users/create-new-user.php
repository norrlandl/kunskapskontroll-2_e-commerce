<?

require('../../../src/config.php');

$firstName = "";
$lastName = "";
$email = "";
$password = "";
$phone = "";
$street = "";
$postalCode = "";
$city = "";
$country = "";

if (isset($_POST["addNewUser"])) {

    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $phone = trim($_POST["phone"]);
    $street = trim($_POST["street"]);
    $postalCode = trim($_POST["postal_code"]);
    $city = trim($_POST["city"]);
    $country = trim($_POST["country"]);


    $sql = "
    INSERT INTO users (first_name, last_name, email,
    password, phone, street, postal_code, city, country) 
    VALUES (:first_name, :last_name, :email, :password,
    :phone, :street, :postal_code, :city, :country);
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":first_name", $firstName);
    $stmt->bindParam(":last_name", $lastName);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":street", $street);
    $stmt->bindParam(":postal_code", $postalCode);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":country", $country);

    $stmt->execute();
}
?>  

<form action="./users.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST" class="form-group">
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?= htmlentities($firstName) ?>"><br>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?= htmlentities($lastName) ?>"><br>
    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= htmlentities($email) ?>"><br>
    <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?= htmlentities($password) ?>"><br>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= htmlentities($phone) ?>"><br>
    <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="<?= htmlentities($street) ?>"><br>
    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="<?= htmlentities($postalCode) ?>"><br>
    <input type="text" class="form-control" id="city" name="city" placeholder="city" value="<?= htmlentities($city) ?>"><br>
    <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?= htmlentities($country) ?>"><br>
    <input type="submit" name="addNewUser" class="btn btn-outline-primary" value="Create new user"><br>
</form>