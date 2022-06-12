<?php

class UserDbHandler
{
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Fetch all users and returns the value
    public function fetchAllUsers()
    {
        $sql = "SELECT * FROM users;";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function deleteUser()
    {
        $sql = "
            DELETE FROM users 
            WHERE id = :id;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $_POST['userId']);
        $stmt->execute();
    }

    /**
     * Challenges/exercieses
     */
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

    public function addUser($username, $email, $password)
    {
        $sql = "
            INSERT INTO users (username, email, password)
            VALUES (:username, :email, :password);
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->execute();
    }

    public function updateUser($id, $username, $email, $password)
    {
        $sql = "
            UPDATE users
            SET username = :username, email = :email, password = :password
            WHERE id = :id
        ";

        $encryptedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $encryptedPassword);
        $stmt->execute();
    }
}
