<?php

require('../../../src/config.php');
$pageTitle = "Uppdatera användare";

$message = "";

$singleUser = $globalDbHandler->fetchById($_GET['userID'], "users");

if (isset($_POST["updateUser"])) {

    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $phone = trim($_POST["phone"]);
    $street = trim($_POST["street"]);
    $postal_code = trim($_POST["postal_code"]);
    $city = trim($_POST["city"]);
    $country = trim($_POST["country"]);

    if (empty($password)) {
        $userDbHandler->updateUser(
            $_GET['userID'],
            $first_name,
            $last_name,
            $email,
            $singleUser["password"],
            $phone,
            $street,
            $postal_code,
            $city,
            $country
        );
    } else {
        $userDbHandler->updateUser(
            $_GET['userID'],
            $first_name,
            $last_name,
            $email,
            $password,
            $phone,
            $street,
            $postal_code,
            $city,
            $country
        );
    }
    redirect("../index.php");
}

?>

<?php include('../layout/header.php'); ?>
<div class="page-wrapper">
    <form action="../index.php">
        <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Tillbaka">
    </form>

    </br>
    </br>
    <form action="" method="POST" class="fm-control">

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">Förnamn</label>
                <input type="text" id="first_name" class="form-control" name="first_name" value="<?= htmlentities($singleUser["first_name"]) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="last_name">Efternamn</label>
                <input type="text" id="last_name" class="form-control" name="last_name" value="<?= htmlentities($singleUser["last_name"]) ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="street">Adress</label>
            <input type="text" id="street" class="form-control" name="street" value="<?= htmlentities($singleUser["street"]) ?>">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">Stad</label>
                <input type="text" id="city" class="form-control" name="city" value="<?= htmlentities($singleUser["city"]) ?>">
            </div>
            <div class="form-group col-md-2">
                <label for="postal_code">Zip</label>
                <input type="text" id="postal_code" class="form-control" name="postal_code" value="<?= htmlentities($singleUser["postal_code"]) ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="country">Land</label>
                <input type="text" id="country" class="form-control" name="country" value="<?= htmlentities($singleUser["country"]) ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-post</label>
                <input type="text" id="email" class="form-control" name="email" value="<?= htmlentities($singleUser["email"]) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Telefon</label>
                <input type="text" id="phone" class="form-control" name="phone" value="<?= htmlentities($singleUser["phone"]) ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="passord">Lösenord</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Lämna tom för samma lösenord">
            </div>
            <div class="form-group col-md-6">
                <label for="confirm">Bekräfta lösenord</label>
                <input type="password" id="confirm_password" class="form-control" name="confirm_password">
            </div>
        </div>

        <input type="submit" name="updateUser" class="btn btn-outline-primary" value="Uppdatera"><br>
    </form>
</div>
<?= $message ?>

<?php include('../../layout/footer.php'); ?>