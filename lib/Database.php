<?php
include '../config/config.php';

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
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    // Select Data
    public function select($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }
        return $result->fetch_assoc();
    }
    // Select All Data
    public function selectAll($query){
        $result = $this->conn->query($query);
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }
        return $result;
    }
    // Insert data
    public function insert($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            die("Insertion failed: " . $this->conn->error);
        }
        return $result;
    }
    // Update data
    public function update($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            die("Update failed: " . $this->conn->error);
        }
        return $result;
    }
    // Delete data
    public function delete($query)
    {
        $result = $this->conn->query($query);
        if (!$result) {
            die("Delete failed: " . $this->conn->error);
        }
        return $result;
    }

    // Close connection
    public function close()
    {
        $this->conn->close();
    }
}
