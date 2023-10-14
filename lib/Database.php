<?php
require_once 'config.php';

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $database = DB_NAME;

    private $conn;

    // Constructor
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
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }


    // Close the database connection
    public function close()
    {
        $this->conn = null;
    }
}
