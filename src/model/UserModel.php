<?php

namespace Model;

use Config\Database;
use PDO;

var_dump($thid->db);
class UserModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connection();
    }

    public function authenticateUser($email, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user['password'] === $password) {
                return $user;
            }
        }

        return false;
    }
}
