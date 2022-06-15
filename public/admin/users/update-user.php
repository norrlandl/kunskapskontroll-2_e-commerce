<?php
require('../../../src/config.php');
$pageTitle = "Uppdatera användare";

$message = "";

if (isset($_POST["updateUser"])) {
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

    redirect("../index.php");
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


<?php include('../layout/header.php'); ?>
<form action="../index.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST">
    <label for="first_name">First name:</label><br>
    <input type="text" class="form-control" name="first_name" value="<?= htmlentities($singleUser["first_name"]) ?>"><br>
    <label for="last_name">Last name:</label><br>
    <input type="text" class="form-control" name="last_name" value="<?= htmlentities($singleUser["last_name"]) ?>"><br>
    <label for="email">Email:</label><br>
    <input type="text" class="form-control" name="email" value="<?= htmlentities($singleUser["email"]) ?>"><br>
    <label for="password">Password:</label><br>
    <input type="password" class="form-control" name="password" value="<?= htmlentities($singleUser["password"]) ?>"><br>
    <label for="confirmPassword">Confirm password:</label><br>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" value="<?= htmlentities($singleUser["password"]) ?>"><br>
    <label for="phone">Phone:</label><br>
    <input type="text" class="form-control" name="phone" value="<?= htmlentities($singleUser["phone"]) ?>"><br>
    <label for="street">Street:</label><br>
    <input type="text" class="form-control" name="street" value="<?= htmlentities($singleUser["street"]) ?>"><br>
    <label for="postal_code">Postal code:</label><br>
    <input type="text" class="form-control" name="postal_code" value="<?= htmlentities($singleUser["postal_code"]) ?>"><br>
    <label for="city">City:</label><br>
    <input type="text" class="form-control" name="city" value="<?= htmlentities($singleUser["city"]) ?>"><br>
    <label for="country">Country:</label><br>
    <input type="text" class="form-control" name="country" value="<?= htmlentities($singleUser["country"]) ?>"><br>
    <input type="submit" name="updateUser" class="btn btn-outline-primary" value="Update"><br>
</form>

<?= $message ?>

<?php include('../../layout/footer.php'); ?>