<?php
require_once 'config.php';

class  Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $database = DB_NAME;

    private $conn;

    public function __construct()
    {
        $this->connectDB();
    }

    // Connect to the database
    private function connectDB()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Prepare and execute a query
    public function query($sql, $params = [])
    {
        if(!$this->conn) {
            $this->connectDB();
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        
        return $stmt;
    }
    
    // Get the last inserted ID
    public function getLastInsertedId()
    {
        return $this->conn->lastInsertId();
    }
}