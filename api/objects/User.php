<?php

include_once(__DIR__ . '/../functions/isCommonPassword.php');


class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    email    = :email,
                    password = :password";
        
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":email", $this->email);

        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $password_hash);
        
        return $stmt->execute();
    }

    function emailExists() {
        $query = "SELECT id, password
                FROM " . $this->table_name . "
                WHERE email = ?
                LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $num = $stmt->rowCount();
    
        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row["id"];
            $this->password = $row["password"];
            return true;
        }
        return false;
    }

    function checkPasswordStrength() {
        if (strlen($this->password) < 8 ||
            isCommonPassword($this->conn, $this->password)) {
            throw new Exception("weak_password");
        }
    
        $containsUpperCase = preg_match("/[A-Z]/", $this->password);
        $containsLowerCase = preg_match("/[a-z]/", $this->password);
        $containsNumber = preg_match("/[0-9]/", $this->password);
    
        if ($containsUpperCase && $containsLowerCase && $containsNumber) {
            return "strong";
        } elseif ($containsUpperCase && $containsNumber ||
                $containsUpperCase && $containsLowerCase ||
                $containsLowerCase && $containsNumber) {
            return "good";
        } else {
            return "weak";
        }
    }
}
