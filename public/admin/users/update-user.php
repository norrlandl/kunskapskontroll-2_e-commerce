<?

require('../../../src/config.php');

if (isset($_POST["updateUser"])) {

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
    UPDATE users
    SET first_name = :first_name, last_name = :last_name,
    email = :email, password = :password, phone = :phone,
    street = :street, postal_code = :postal_code, city = :city,
    country = :country
    WHERE id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['userID']);
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
     
    $sql = "
    SELECT * FROM users
    WHERE id = :id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['userID']);
    $stmt->execute();
    $singleUser = $stmt->fetch();
    ?>

<form action="./users.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST">
    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?= htmlentities($singleUser["first_name"]) ?>" ><br>
    <input type="text" class="form-control"  name="last_name" placeholder="Last Name" value="<?= htmlentities($singleUser["last_name"]) ?>"><br>
    <input type="text" class="form-control"  name="email" placeholder="Email" value="<?= htmlentities($singleUser["email"]) ?>"><br>
    <input type="text" class="form-control"  name="password" placeholder="Password" value="<?= htmlentities($singleUser["password"]) ?>"><br>
    <input type="text" class="form-control"  name="phone" placeholder="Phone" value="<?= htmlentities($singleUser["phone"]) ?>"><br>
    <input type="text" class="form-control"  name="street" placeholder="Street" value="<?= htmlentities($singleUser["street"]) ?>"><br>
    <input type="text" class="form-control"  name="postal_code" placeholder="Postal Code" value="<?= htmlentities($singleUser["postal_code"]) ?>"><br>
    <input type="text" class="form-control"  name="city" placeholder="City" value="<?= htmlentities($singleUser["city"]) ?>"><br>
    <input type="text" class="form-control"  name="country" placeholder="Country" value="<?= htmlentities($singleUser["country"]) ?>"><br>
    <input type="submit" name="updateUser" class="btn btn-outline-primary" value="Update"><br>
</form>
