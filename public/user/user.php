<?php
   require('../../src/dbconnect.php');
   $pageTitle = "Användare";
   $pageId    = "user";

   $success = "";

   //  echo "<pre>";
   //  print_r($_POST);
   //  echo "</pre>";


   /**
   * DELETE 
   */

   if (isset($_POST['deleteUser'])) {

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

   $sql = "
   DELETE FROM users 
   WHERE id = :id";

   $stmt = $dbconnect->prepare($sql);
   $stmt->bindParam(":id", $_POST['userID']);
   $stmt->execute();

   header("Location: user-login.php");
 }


  /**
   * FETCH 
   */
   $sql = "
   SELECT * FROM users
   ";

   $stmt = $dbconnect->query($sql); 
   $user = $stmt->fetch();

   echo "<pre>";
   print_r($user);
   echo "</pre>";

?>


<h1>User.php</h1>



<p>Du är inloggad</p>



<?php ?>

<?=$success ?>

   <h4>Välkommen <?=htmlentities($user['first_name']) ?></h4>
   <h4>Dina uppgifter</h4>
   <p><?=htmlentities($user['first_name']) ?></p>
   <p><?=htmlentities($user['last_name']) ?></p>
   <p><?=htmlentities($user['city']) ?></p>
   <p><?=htmlentities($user['id']) ?></p>


   <!-- <h4>Tidigare ordrar</h4>
   <h4>Radera konto</h4> -->
   <form method="POST" action="">
      <input type="hidden" name="userID" value="<?=htmlentities($user['id']) ?>">
      <input type="submit" name="deleteUser" value="Radera konto">
   </form>
<?php ?>