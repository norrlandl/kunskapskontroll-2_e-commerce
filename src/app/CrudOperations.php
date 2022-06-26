<?php

// Note: ev. optimera en del querys och bara välja specifikt det vi behöver hämta.

class GlobalDbHandler
// Hantera alla globala anrop
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAllFromDb($tableName)
    {
        $sql = "
        SELECT * FROM $tableName
        ";
        $stmt = $this->pdo->query($sql);

        return array_reverse($stmt->fetchAll());
    }

    public function fetchById($id, $tableName)
    {
        $sql = "
        SELECT * FROM $tableName
        WHERE id = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteFromDb($id, $tableName)
    {
        $sql = "
        DELETE FROM $tableName 
        WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function clearTableInDb($tableName)
    {
        $sql = "
        DELETE FROM $tableName
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}

class ProductDbHandler
// Hantera alla anrop till products table
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addProductToDb($title, $description, $price, $stock, $img)
    {
        $sql = "
        INSERT INTO products (title, description, price, stock, img_url) 
        VALUES (:title, :description, :price, :stock, :img_url);
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":stock", $stock);
        $stmt->bindParam(":img_url", $img);
        $stmt->execute();
    }

    public function updateProduct(
        $id,
        $title,
        $description,
        $price,
        $stock,
    ) {

        $sql = "
        UPDATE products
        SET title = :title, description = :description,
        price = :price, stock = :stock
        WHERE id = :id;
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->execute();
    }
}

class UserDbHandler
// Hantera alla anrop till users table
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchUserById($id)
    {
        $sql = "
        SELECT * FROM users
        WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function fetchUserByEmail($email)
    {
        $sql = "
        SELECT * FROM users
        WHERE email = :email
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function addUserToDb(
        $firstName,
        $lastName,
        $email,
        $phone,
        $street,
        $postalCode,
        $city,
        $country,
        $password,
    ) {

        $sql = "
        INSERT INTO users (first_name, last_name, email,
        password, phone, street, postal_code, city, country) 
        VALUES (:first_name, :last_name, :email, :password,
        :phone, :street, :postal_code, :city, :country);
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $encryptedPassword);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":street", $street);
        $stmt->bindParam(":postal_code", $postalCode);
        $stmt->bindParam(":city", $city);
        $stmt->bindParam(":country", $country);
        $stmt->execute();

        $firstName = "";
        $lastName = "";
        $email = "";
        $password = "";
        $phone = "";
        $street = "";
        $postalCode = "";
        $city = "";
        $country = "";
    }


    public function updateUser(
        $id,
        $firstName,
        $lastName,
        $email,
        $password,
        $phone,
        $street,
        $postalCode,
        $city,
        $country
    ) {

        $sql = "
        UPDATE users
        SET first_name = :first_name, last_name = :last_name,
        email = :email, password = :password, phone = :phone,
        street = :street, postal_code = :postal_code, city = :city,
        country = :country
        WHERE id = :id;
        ";

        $stmt = $this->pdo->prepare($sql);
        if (str_starts_with($password, "$2y$12$")) {
            $stmt->bindParam(":password", $password);
        } else {
            $encryptPW = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
            $stmt->bindParam(":password", $encryptPW);
        }

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":street", $street);
        $stmt->bindParam(":postal_code", $postalCode);
        $stmt->bindParam(":city", $city);
        $stmt->bindParam(":country", $country);

        $stmt->execute();
    }
}


class OrderdbHandler
// Hantera alla anrop till order och order_items tables
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createNewOrder($userId, $cartTotalSum, $fullName, $street, $postal_code, $city, $country)
    {
        $sql = "
        INSERT INTO orders 
        (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
        VALUES 
        (:user_id, :total_price, :billing_full_name, :billing_street, :billing_postal_code, :billing_city, :billing_country);
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id',              $userId);
        $stmt->bindParam(':total_price',          $cartTotalSum);
        $stmt->bindParam(':billing_full_name',    $fullName);
        $stmt->bindParam(':billing_street',       $street);
        $stmt->bindParam(':billing_postal_code',  $postal_code);
        $stmt->bindParam(':billing_city',         $city);
        $stmt->bindParam(':billing_country',      $country);
        $stmt->execute();
    }

    public function createOrderDetails($orderId, $productId, $title, $qty, $price)
    {
        $sql = "
        INSERT INTO order_items (order_id, product_id, product_title, quantity, unit_price)
        VALUES (:order_id, :product_id, :product_title, :quantity, :unit_price);
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':order_id',       $orderId);
        $stmt->bindValue(':product_id',     $productId);
        $stmt->bindValue(':product_title',  $title);
        $stmt->bindValue(':quantity',       $qty);
        $stmt->bindValue(':unit_price',     $price);
        $stmt->execute();
    }
}
