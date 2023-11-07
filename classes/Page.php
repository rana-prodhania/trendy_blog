<?php
$realPath = dirname(__FILE__);
require_once $realPath . './../lib/Database.php';
require_once $realPath . './../helpers/Helper.php';

class Page
{
 private $db;
 private $helper;

 // public $error = [];

 public $success = []; 


 public function __construct()
 {
  $this->db = new Database();
  $this->helper = new Helper();
 }

 // about me
 public function aboutMe($data)
 {
  try {
   $title = $this->helper->sanitize($data['title']);
   $description = $this->helper->sanitize($data['description']);
   $address = $this->helper->sanitize($data['address']);
   $facebook = $this->helper->sanitize($data['facebook']);
   $linkedin = $this->helper->sanitize($data['linkedin']);
   $github = $this->helper->sanitize($data['github']);

   $query = "INSERT INTO about_page (id, title, description, address, facebook, linkedin, github) 
   VALUES (:id, :title, :description, :address, :facebook, :linkedin, :github) 
   ON DUPLICATE KEY UPDATE 
   title = VALUES(title), description = VALUES(description), address = VALUES(address), 
   facebook = VALUES(facebook), linkedin = VALUES(linkedin), github = VALUES(github)";

   $params = [
    ':id' => 1,
    ':title' => $title,
    ':description' => $description,
    ':address' => $address,
    ':facebook' => $facebook,
    ':linkedin' => $linkedin,
    ':github' => $github

   ];
   $result = $this->db->query($query, $params);
   if (!$result) {
    throw new Exception("Something went wrong");
   }
   $_SESSION['success'] = "About me updated successfully";
   $this->helper->redirect('about.php');
  } catch (Exception $e) {
   $this->error = $e->getMessage();
  }

 }
 // get about me
 public function getAboutMe()
 {
  try {
   $query = "SELECT * FROM about_page WHERE id = :id";
   $params = [':id' => 1];
   $result = $this->db->query($query, $params);
   return $result->fetch(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
   $this->error = $e->getMessage();
  }
 }

 // add contact
 public function addContact($data)
 {
     try {
         $query = "INSERT INTO contact_page (name, email, message) VALUES (:name, :email, :message)";
         $params = [
             ':name' => $data['name'],
             ':email' => $data['email'],
             ':message' => $data['message']
         ];
         $result = $this->db->query($query, $params);
         if (!$result) {
             throw new Exception("Something went wrong");
         }
         return $this->success['message'] = 'Message sent successfully';
     } catch (Exception $e) {
         $this->error = $e->getMessage();
     }
 }

 // get all contact messages
 public function getAllContactMessages()
 {
   try {
     $query = "SELECT * FROM contact_page";
     $result = $this->db->query($query);
     if (!$result) {
       throw new Exception("Contact messages not found");
     }
     return $result;
   } catch (Exception $e) {
     $this->error = $e->getMessage();
   }
 }

 // get a contact message
 public function getContactMessage($id)
 {
   try {
     $query = "SELECT * FROM contact_page WHERE id = ?";
     $result = $this->db->query($query, [$id])->fetch(PDO::FETCH_ASSOC);
     if (!$result) {
       throw new Exception("Contact message not found");
     }
     return $result;
   } catch (Exception $e) {
     $this->error = $e->getMessage();
   }
 }

 // delete contact message
 public function deleteContactMessage($id)
 {
   try {
     $query = "DELETE FROM contact_page WHERE id = ?";
     $result = $this->db->query($query, [$id]);
     if (!$result) {
       throw new Exception("Failed to delete contact message");
     }
     $_SESSION['success'] = "Contact message deleted successfully";
     $this->helper->redirect('contact-msg.php');
   } catch (Exception $e) {
     return $e->getMessage();
   }
 }




}