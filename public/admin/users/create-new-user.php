<?php

require('../../../src/config.php');
$pageTitle = "Skapa användare";

$message = "";

$firstName = "";
$lastName = "";
$email = "";
$password = "";
$confirmPassword = "";
$phone = "";
$street = "";
$postalCode = "";
$city = "";
$country = "";

if (isset($_POST["addNewUser"])) {

    if (trim($_POST["password"]) !== trim($_POST["confirmPassword"])) {
        $message = '
            <div>
                Confirmed password incorrect!
            </div>
        ';
    } else {
        $userDbHandler->addUserToDb(
            trim($_POST["first_name"]),
            trim($_POST["last_name"]),
            trim($_POST["email"]),
            trim($_POST["password"]),
            trim($_POST["phone"]),
            trim($_POST["street"]),
            trim($_POST["postal_code"]),
            trim($_POST["city"]),
            trim($_POST["country"]),
        );

        redirect("../index.php");
    }
}
?>

<?php include('../layout/header.php'); ?>
<form action="../index.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST" class="fm-control"><br><br>
    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="<?= htmlentities($firstName) ?>"><br><br>
    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?= htmlentities($lastName) ?>"><br><br>
    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= htmlentities($email) ?>"><br><br>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= htmlentities($password) ?>"><br><br>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" value="<?= htmlentities($confirmPassword) ?>"><br><br>
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?= htmlentities($phone) ?>"><br><br>
    <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="<?= htmlentities($street) ?>"><br><br>
    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="<?= htmlentities($postalCode) ?>"><br><br>
    <input type="text" class="form-control" id="city" name="city" placeholder="city" value="<?= htmlentities($city) ?>"><br><br>
    <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?= htmlentities($country) ?>"><br><br>
    <input type="submit" name="addNewUser" class="btn btn-outline-primary" value="Create new user"><br><br>
</form>

<?= $message ?>

<?php include('../../layout/footer.php'); ?>