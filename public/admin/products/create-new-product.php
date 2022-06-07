<?

require('../../../src/config.php');

$title = "";
$description = "";
$price = "";
$stock = "";

if (isset($_POST["addNewProduct"])) {

    
    if (is_uploaded_file($_FILES['uploadedFile']['tmp_name'])) {
        // This is the actuall name of the file
		$fileName 	    = $_FILES['uploadedFile']['name'];
		$fileType 	    = $_FILES['uploadedFile']['type'];
		$fileTempPath   = $_FILES['uploadedFile']['tmp_name'];
		$path 		    = '../../img/';
		// uploads/dummy-profile.png
		$newFilePath = $path . $fileName; 
    }
    
    move_uploaded_file($fileTempPath, $newFilePath);
    
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    $stock = trim($_POST["stock"]);
    $stock = trim($_POST["stock"]);

    $sql = "
    INSERT INTO products (title, description, price, stock) 
    VALUES (:title, :description, :price, :stock);
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":stock", $stock);
    $stmt->execute();
}
?>  

<form action="../index.php">
    <input type="submit" class="btn btn-outline-secondary" value="&#x2190; Go back">
</form>

</br>
</br>
<form action="" method="POST" class="form-group" enctype="multipart/form-data">
    <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= htmlentities($title) ?>"><br>
    <textarea rows="6" cols="60" class="form-control" id="description" name="description" placeholder="Description"><?= htmlentities($description) ?></textarea><br>
    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="price" name="price" placeholder="Price" value="<?= htmlentities($price) ?>"><br>
    <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?= htmlentities($stock) ?>"><br>
    <label for="image">Add image:</label><br>
        <input type="file" class="form-control" id="image" name="uploadedFile" placeholder="Add image" value="<?= htmlentities($stock) ?>"><br><br>
    <input type="submit" name="addNewProduct" class="btn btn-outline-primary" value="Create new product"><br>
</form>

<img src="<?=$newFilePath?>">