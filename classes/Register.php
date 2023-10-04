<?php

require_once '../lib/Database.php';
require_once '../helpers/Format.php';

class Register
{
    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    // Add User
    public function addUser($data)
    {
        $name = $this->format->sanitize($data['name']);
        $username = $this->format->sanitize($data['username']);
        $email = $this->format->sanitize($data['email']);
        $password = $this->format->sanitize($data['password']);

        if (empty($name) || empty($username) || empty($email) || empty($password)) {
            return "All input fields are required!";
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format!";
        }

        // Check if email exists
        $queryEmail = "SELECT * FROM users WHERE email = '$email'";
        $resultEmail = $this->db->select($queryEmail);
        if ($resultEmail) {
            return "Email already exists!";
        }

        // Check if username exists
        $queryUsername = "SELECT * FROM users WHERE username = '$username'";
        $resultUsername = $this->db->select($queryUsername);
        if ($resultUsername) {
            return "Username already exists!";
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, username, email, password) VALUES('$name', '$username', '$email', '$hashedPassword')";
        $inserted = $this->db->insert($query);
        if ($inserted) {
            header('Location: ../admin/login.php');
            exit;
        } else {
            return "Registration failed!";
        }
    }
}
