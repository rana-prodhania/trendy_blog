<?php
$realPath = dirname(__FILE__);
require_once $realPath. './../lib/Database.php';
require_once '../helpers/Helper.php';

class Login
{
    public $db;
    private $helper;

    public function __construct()
    {
        $this->db = new Database();
        $this->helper = new Helper();
        session_start();
    }

    // Login
    public function login($data)
    {
        $email = $this->helper->sanitize($data['email']);
        $password = $this->helper->sanitize($data['password']);

        if (empty($email) || empty($password)) {
            return "All fields are required!";
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format!";
        }

        if(strlen($password) < 6) {
            return "Password must be at least 6 characters!";
        }


        $query = "SELECT * FROM admins WHERE email = ?";
        $stmt = $this->db->query($query, [$email]);
        
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $result['password'])) {
                $_SESSION['id'] = $result['id'];
                $_SESSION['name'] = $result['name'];
                $_SESSION['avatar'] = $result['avatar'];
                header('Location: dashboard.php');
                exit();
            } else {
                return "Incorrect password!";
            }
        } else {
            
            return "Incorrect email or password!";
        }
    }
}
