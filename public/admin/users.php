<?

require('../../src/config.php');

if (isset($_POST["deleteUserBTN"])) {
    $sql = "
    DELETE FROM users
    WHERE id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $_POST['userID']);
    $stmt->execute();
}
    
    
if (isset($_POST["clearAllUsers"])) {
    $sql = "
    DELETE FROM users
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

    $stmt = $pdo->query("SELECT * FROM users");
    $users = array_reverse($stmt->fetchAll());

// Ovan skrivs om till klasser

?>

<div class="top-buttons">
    <form action="./create-new-user.php">
        <input type="submit" class="btn btn-outline-primary" value="Create new user">
    </form>
    <form action="" method="POST">
        <input type="submit" name="clearAllUsers" class="btn btn-outline-secondary" value="Clear all">
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Second Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Street</th>
            <th>Postal Code</th>
            <th>City</th>
            <th>Country</th>
            <th>Created</th>
            <th>Manage</th>
        </tr>
    </thead>
    <br>
    <tbody>
        <? foreach ($users as $user) : ?>
            <tr>
                <td><?= htmlentities($user["id"]) ?></td>
                <td><?= htmlentities($user["first_name"]) ?></td>
                <td><?= htmlentities($user["last_name"]) ?></td>
                <td><?= htmlentities($user["email"]) ?></td>
                <td><?= htmlentities($user["password"]) ?></td>
                <td><?= htmlentities($user["phone"]) ?></td>
                <td><?= htmlentities($user["street"]) ?></td>
                <td><?= htmlentities($user["postal_code"]) ?></td>
                <td><?= htmlentities($user["city"]) ?></td>
                <td><?= htmlentities($user["country"]) ?></td>
                <td><?= htmlentities($user["create_date"]) ?></td>

                <td class="action">
                    <form action="./update-user.php" method="GET">
                        <input type="hidden" name="userID" value="<?= htmlentities($user["id"]) ?>">
                        <input type="submit" class="btn btn-dark" value="Update">
                    </form>
                    <form action="" method="POST">
                        <input type="hidden" name="userID" value="<?= $user['id'] ?>">
                        <input type="submit" name="deleteUserBTN" class="btn btn-dark" value="Delete">
                    </form>
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
</table>