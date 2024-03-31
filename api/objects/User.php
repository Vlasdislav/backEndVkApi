<?php

class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name .
                "SET
                    email    = :email,
                    password = :password";
        
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":email", $this->email);

        $password_hash = password_hash($this->password);
        $stmt->bindParam(":password", $this->password_hash);

        return $stmt->execute();
    }

    // TODO: emailExists()
}