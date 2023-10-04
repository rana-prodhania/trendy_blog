<?php

require_once '../lib/Database.php';
require_once '../helpers/Format.php';

class Login
{
    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
        session_start();
    }

    public function login($data)
    {
        $email = $this->format->sanitize($data['email']);
        $password = $this->format->sanitize($data['password']);

        // Fetch user data by email
        $query = "SELECT * FROM users WHERE email = '$email'";
        $user = $this->db->select($query);

        if (empty($email) || empty($password)) {
            return "All fields are required!";
        }

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $this->db->close();
            header("Location: index.php");
            exit;
        } else {
            $this->db->close();
            return "email or password is incorrect!";
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }
}
