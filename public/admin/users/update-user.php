<?php

require('../../../src/config.php');
$pageTitle = "Uppdatera användare";

$message = "";

$singleUser = $userDbHandler->fetchById($_GET['productID'], "users");

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

    if (empty($password)) {
        $userDbHandler->updateUser(
            $_GET['userID'],
            $firstName,
            $lastName,
            $email,
            $singleUser["password"],
            $phone,
            $street,
            $postalCode,
            $city,
            $country
        );
    } else {
        $userDbHandler->updateUser(
            $_GET['userID'],
            $firstName,
            $lastName,
            $email,
            $password,
            $phone,
            $street,
            $postalCode,
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
    <form action="" method="POST">
        <label for="first_name">Förnamn:</label><br>
        <input type="text" class="form-control" name="first_name" value="<?= htmlentities($singleUser["first_name"]) ?>"><br>
        <label for="last_name">Efternamn:</label><br>
        <input type="text" class="form-control" name="last_name" value="<?= htmlentities($singleUser["last_name"]) ?>"><br>
        <label for="email">Email:</label><br>
        <input type="text" class="form-control" name="email" value="<?= htmlentities($singleUser["email"]) ?>"><br>
        <label for="password">Lösenord:</label><br>
        <input type="password" class="form-control" name="password" placeholder="Lämna tom för samma lösenord"><br>
        <label for="phone">Telefon:</label><br>
        <input type="text" class="form-control" name="phone" value="<?= htmlentities($singleUser["phone"]) ?>"><br>
        <label for="street">Address:</label><br>
        <input type="text" class="form-control" name="street" value="<?= htmlentities($singleUser["street"]) ?>"><br>
        <label for="postal_code">Postkod:</label><br>
        <input type="text" class="form-control" name="postal_code" value="<?= htmlentities($singleUser["postal_code"]) ?>"><br>
        <label for="city">Stad:</label><br>
        <input type="text" class="form-control" name="city" value="<?= htmlentities($singleUser["city"]) ?>"><br>
        <label for="country">Land:</label><br>
        <input type="text" class="form-control" name="country" value="<?= htmlentities($singleUser["country"]) ?>"><br>
        <input type="submit" name="updateUser" class="btn btn-outline-primary" value="Uppdatera"><br>
    </form>
</div>
<?= $message ?>

<?php include('../../layout/footer.php'); ?>