<?php
$realPath = dirname(__FILE__);
require_once $realPath . './../lib/Database.php';
require_once $realPath . './../helpers/Helper.php';

class SiteSetting{
 private $db;
 private $helper;

 public $error = [];

 public $success = []; 


 public function __construct()
 {
  $this->db = new Database();
  $this->helper = new Helper();
 }

 // Add or Update Site Settings
 public function updateSiteSetting($data)
 {
  try {
   $site_title = $this->helper->sanitize($data['site_title']);
   $logo_text = $this->helper->sanitize($data['logo_text']);
   $description = $this->helper->sanitize($data['description']);
   $keywords = $this->helper->sanitize($data['keywords']);
   $pagination = $this->helper->sanitize($data['pagination']);
   $pop_per_page = $this->helper->sanitize($data['pop_per_page']);
   $rel_posts_limit= $this->helper->sanitize($data['rel_posts_limit']);

   $query = "INSERT INTO site_settings (id, site_title,logo_text, description, keywords, pagination, pop_per_page, rel_posts_limit) VALUES (:id,:site_title,:logo_text,:description, :keywords, :pagination, :pop_per_page, :rel_posts_limit) 

   ON DUPLICATE KEY UPDATE site_title = VALUES(site_title), logo_text = VALUES(logo_text), description = VALUES(description), keywords = VALUES(keywords), pagination = VALUES(pagination), pop_per_page = VALUES(pop_per_page), rel_posts_limit = VALUES(rel_posts_limit)";
   $params = [
    ":id" => 1,
    ':site_title' => $site_title,
    ':logo_text' => $logo_text,
    ':description' => $description,
    ':keywords' => $keywords,
    ':pagination' => $pagination,
    ':pop_per_page' => $pop_per_page,
    ':rel_posts_limit' => $rel_posts_limit
   ];
   $result = $this->db->query($query, $params);
   if (!$result) {
    throw new Exception("Something went wrong");
   }
   $_SESSION['success'] = "Site settings added successfully";
   $this->helper->redirect('site_settings.php');
  } catch (Exception $e) {
   $this->error = $e->getMessage();
  }
 }

 // Get Site Settings
 public function getSiteSetting()
 {
  try {
   $query = "SELECT * FROM site_settings WHERE id = :id";
   $params = [":id" => 1];
   $result = $this->db->query($query, $params);
   if (!$result) {
    throw new Exception("Something went wrong");
   }
   return $result->fetch(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
   $this->error = $e->getMessage();
  }
 }
}