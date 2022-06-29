<?php

require('../../../src/config.php');
$pageTitle = "Skapa användare";

$error = "";
$message = "";

$firstName = "";
$lastName = "";
$street = "";
$postalCode = "";
$city = "";
$country = "";
$phone = "";
$email = "";
$password = "";
$confirmPassword = "";

if (isset($_POST["addNewUser"])) {

    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["confirm_password"]);
    $phone = trim($_POST["phone"]);
    $street = trim($_POST["street"]);
    $postalCode = trim($_POST["postal_code"]);
    $city = trim($_POST["city"]);
    $country = trim($_POST["country"]);


    if (empty($firstName)) {
        $error .= "<li>Förnamn är obligatoriskt</li>";
    }

    if (empty($lastName)) {
        $error .= "<li>Efternamn är obligatoriskt</li>";
    }

    if (empty($email)) {
        $error .= "<li>Mejladress är obligatoriskt</li>";
    }

    if (empty($phone)) {
        $error .= "<li>Telefonnummer är obligatoriskt</li>";
    }

    if (empty($street)) {
        $error .= "<li>Address är obligatoriskt</li>";
    }

    if (empty($postalCode)) {
        $error .= "<li>Postkod är obligatoriskt</li>";
    }

    if (empty($city)) {
        $error .= "<li>Stad är obligatoriskt</li>";
    }

    if (empty($password)) {
        $error .= "<li>Lösenord är obligatoriskt</li>";
    }

    if ($password !== $confirmPassword) {
        $error .= '
            <li>
                Lösenorden måste stämma med varandra
            </li>
        ';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error .= "<li>Ogiltig e-post<li>";
    }

    if ($error) {
        $message = "
          <ul class='alert alert-danger list-unstyled'>
            $error
          </ul>
          ";
    } else {

        try {
            $userDbHandler->addUserToDb(
                $firstName,
                $lastName,
                $email,
                $phone,
                $street,
                $postalCode,
                $city,
                $country,
                $password,
            );

            redirect("../index.php");
        } catch (\PDOException $e) {
            if ((int) $e->getCode() === 23000) {
                $message = "
                    <li class='alert alert-danger list-unstyled'>
                        E-post addressen är redan taget. Var snäll ange en annan e-post
                    </li>
                ";
            } else {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
    }
}
?>

<?php include('../layout/header.php'); ?>
<div class="page-wrapper">

    <h4>Skapa ny användare</h4>

    <?= $message ?>

    <form action="" method="POST" class="fm-control">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cart_first_name">Förnamn</label>
                <input type="text" id="first_name" class="form-control" name="first_name" value="<?= htmlentities($firstName) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="cart_last_name">Efternamn</label>
                <input type="text" id="last_name" class="form-control" name="last_name" value="<?= htmlentities($lastName) ?>">
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
                <input type="text" id="postal_code" class="form-control" name="postal_code" value="<?= htmlentities($postalCode) ?>">
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

        <input type="submit" name="addNewUser" class="btn btn-success float-right btn-margin" value="&#10003; Skapa ny">

    </form>
    <form action="../index.php">
        <input type="submit" class="btn btn-secondary float-left btn-margin" value="&#x2190; Tillbaka">
    </form>

</div>

<?php include('../layout/footer.php'); ?>