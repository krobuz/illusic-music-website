<?php
class User {
    private $conn;
    private $table_name = "users";
    
    public $id;
    public $username;
    public $password;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function register($username, $password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            echo "Passwords do not match. Please try again.";
            return false;
        }
    
        $query = "INSERT INTO " . $this->table_name . " 
                  SET username = :username, 
                      password = :password";
    
        $stmt = $this->conn->prepare($query);
    
        $username = htmlspecialchars(strip_tags($username));
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPassword);
    
        if ($stmt->execute()) {
            echo "Registration successful. Please login.";
            return true;
        }
    
        echo "Error during registration. Please try again.";
        return false;
    }
    
    
    public function login($username, $password) {
        $query = "SELECT id, username, password 
                FROM " . $this->table_name . " 
                WHERE username = :username";
        
        $stmt = $this->conn->prepare($query);
        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }
}