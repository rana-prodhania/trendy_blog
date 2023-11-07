<?php
$realPath = dirname(__FILE__);
require_once $realPath . './../lib/Database.php';
require_once $realPath . './../helpers/Helper.php';

class Profile
{
  private $db;
  private $helper;

  public $error = [];


  public function __construct()
  {
    $this->db = new Database();
    $this->helper = new Helper();
  }


  // Update User
  public function updateProfile($data, $file)
  {
    try {
      $name = $this->helper->sanitize($data['name']);
      $email = $this->helper->sanitize($data['email']);
      $avatar = $file['avatar'];
      $oldImage = $data['old-image'];

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error['email'] = 'Invalid email format';
        return;
      }

      if (strlen($name) < 3 || strlen($name) > 25) {
        $this->error['name'] = 'Name should be between 3 and 25 characters';
        return;
      }

      // Check if a new image is provided
      if (isset($file['avatar']['name']) && !empty($file['avatar']['name'])) {
        // Get the old image path
        $profile = $this->getProfile();
        $oldImage = 'uploads/profile/' . $profile['avatar'];
        
        $avatar = $this->helper->uploadImage($avatar, $oldImage, 'uploads/profile/');

      } else {
        $avatar = $oldImage;
      }

      $query = "UPDATE admins SET name = :name, email = :email, avatar = :avatar WHERE id = :id";
      $params = [
        ':name' => $name,
        ':email' => $email,
        ':id' => $_SESSION['id'],
        ':avatar' => $avatar
      ];
      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Profile not updated!");
      }
      $_SESSION['success'] = "Profile updated successfully!";
      $this->helper->redirect('profile.php');

    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  

  // Update Password
  public function updatePassword($data)
  {
    try {
      $id = $_SESSION['id'];
      $newPassword = $data['newPassword'];
      $oldPassword = $data['currentPassword'];
      $storedPassword = $this->getProfile();

      if (empty($oldPassword)) {
       $this->error['currentPassword'] = 'Current password is required';
        return;
      }

      if (empty($newPassword)) {
        $this->error['newPassword'] = 'New password is required';
        return;
      }
      

      if (!password_verify($oldPassword, $storedPassword['password'])) {
        $this->error['currentPassword'] = 'Current password is incorrect';
        return;
      }


      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $query = "UPDATE admins SET password = :password WHERE id = :id";
      $params = [
        ':password' => $hashedPassword,
        ':id' => $id
      ];
      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Password not updated!");
      }
      $_SESSION['success'] = "Password updated successfully!";
      $this->helper->redirect('profile.php');

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  // Get Profile
  public function getProfile()
  {
    try {
      $id = $_SESSION['id'];
      $query = "SELECT * FROM admins WHERE id = :id";
      $params = [
        ':id' => $id
      ];
      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Profile not found!");
      }
      return $result->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  // Delete Account
  public function deleteAccount()
  {
    try {
      $id = $_SESSION['id'];
      $query = "DELETE FROM admins WHERE id = :id";
      $params = [
        ':id' => $id
      ];
      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Account deletion failed!");
      }
      session_destroy();
      $this->helper->redirect("index.php");
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

}