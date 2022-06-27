<?php

require('../../../src/config.php');
$pageTitle = "Skapa användare";

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
$confirm_password = "";

if (isset($_POST["addNewUser"])) {

    if (trim($_POST["password"]) !== trim($_POST["confirm_password"])) {
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
            trim($_POST["phone"]),
            trim($_POST["street"]),
            trim($_POST["postal_code"]),
            trim($_POST["city"]),
            trim($_POST["country"]),
            trim($_POST["password"]),
        );

        redirect("../index.php");
    }
}
?>

<?php include('../layout/header.php'); ?>
<div class="page-wrapper">
    <form action="../index.php">
        <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Tillbaka">
    </form>
    <form action="" method="POST" class="fm-control">
        <?= $message ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cart_first_name">Förnamn</label>
                <input type="text" id="first_name" class="form-control" name="first_name" value="<?= htmlentities($first_name) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="cart_last_name">Efternamn</label>
                <input type="text" id="last_name" class="form-control" name="last_name" value="<?= htmlentities($last_name) ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="cart_street">Adress</label>
            <input type="text" id="street" class="form-control" name="street" value="<?= htmlentities($street) ?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cart_city">Stad</label>
                <input type="text" id="city" class="form-control" name="city" value="<?= htmlentities($city) ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="cart_postal_code">Zip</label>
                <input type="text" id="postal_code" class="form-control" name="postal_code" value="<?= htmlentities($postal_code) ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="cart_country">Land</label>
                <input type="text" id="country" class="form-control" name="country" value="<?= htmlentities($country) ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cart_email">E-post</label>
                <input type="text" id="email" class="form-control" name="email" value="<?= htmlentities($email) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="cart_phone">Telefon</label>
                <input type="text" id="phone" class="form-control" name="phone" value="<?= htmlentities($phone) ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cart_passord">Lösenord</label>
                <input type="password" id="password" class="form-control" name="password">
            </div>
            <div class="form-group col-md-6">
                <label for="cart_confirm">Bekräfta lösenord</label>
                <input type="password" id="confirm_password" class="form-control" name="confirm_password">
            </div>
        </div>

        <input type="submit" name="addNewUser" class="btn btn-success" value="Skapa ny">

    </form>

</div>


<?php include('../../layout/footer.php'); ?>