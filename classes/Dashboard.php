<?php
$realPath = dirname(__FILE__);
require_once $realPath . './../lib/Database.php';
class Dashboard
{
 private $db;

 public function __construct()
 {
  $this->db = new Database();
 }

 // All Post Count
 public function getAllPostCount()
 {
  try {
   $query = "SELECT COUNT(*) as count FROM posts";
   $result = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
   $count = str_pad($result['count'], 2, '0', STR_PAD_LEFT);
   return $count;
  } catch (PDOException $e) {
   return $e->getMessage();
  }
 }
 // All Draft Post Count
 public function getAllDraftPostCount()
 {
  try {
   $query = "SELECT COUNT(*) as count FROM posts WHERE status = '0'";
   $result = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
   $count = str_pad($result['count'], 2, '0', STR_PAD_LEFT);
   return $count;
  } catch (PDOException $e) {
   return $e->getMessage();
  }
 }
 // All Published Post Count
 public function getAllPublishedPostCount()
 {
  try {
   $query = "SELECT COUNT(*) as count FROM posts WHERE status = '1'";
   $result = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
   $count = str_pad($result['count'], 2, '0', STR_PAD_LEFT);
   return $count;
  } catch (PDOException $e) {
   return $e->getMessage();
  }
 }

 // All Category Count
 public function getAllCategoryCount()
 {
  try {
   $query = "SELECT COUNT(*) as count FROM categories";
   $result = $this->db->query($query)->fetch(PDO::FETCH_ASSOC);
   $count = str_pad($result['count'], 2, '0', STR_PAD_LEFT);
   return $count;
  } catch (PDOException $e) {
   return $e->getMessage();
  }
 }


}