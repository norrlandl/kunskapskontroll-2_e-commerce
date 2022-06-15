<?php

class UserDbHandler
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAllFromDb($tableName)
    {
        $sql = "SELECT * FROM $tableName";

        $stmt = $this->pdo->query($sql);

        return array_reverse($stmt->fetchAll());
    }

    public function deleteFromDb($tableName, $id)
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
        $sql = " DELETE FROM $tableName ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function fetchUserByEmail($email)
    {
        $sql = "
            SELECT id, username, password FROM users
            WHERE email = :email
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    //Bygga separata klasser för validering och kalla på de i dessa klasser?
    //Eller bygga de här direkt i klasserna?
    public function addProductToDb($title, $description, $price, $stock, $img)
    {
        $sql =
            "
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

    //Bygga separata klasser för validering och kalla på de i dessa klasser?
    //Eller bygga de här direkt i klasserna?
    public function addUserToDb(
        $firstName,
        $lastName,
        $email,
        $password,
        $phone,
        $street,
        $postalCode,
        $city,
        $country,
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

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['userID']);
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
    }

    public function updateProduct(
        $description,
        $title,
        $price,
        $stock,
    ) {

        $sql = "
        UPDATE products
        SET description = :description, title = :title,
        price = :price, stock = :stock
        WHERE id = :id;
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_GET['productID']);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->execute();
    }
}
