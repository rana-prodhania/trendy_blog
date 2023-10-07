<?php

require_once '../lib/Database.php';
require_once '../helpers/Format.php';

class Category
{
    private $db;
    private $format;

    public function __construct()
    {
        $this->db = new Database();
        $this->format = new Format();
    }

    // Create Category
    public function addCategory($data)
    {
        $name = $this->format->sanitize($data['category-name']);
        
        // Check if name is empty
        if (empty($name)) {
            return "Category name is required!";
        }

        // Check if name exists
        $queryName = "SELECT * FROM categories WHERE name = '$name'";
        $resultName = $this->db->select($queryName);
        if ($resultName) {
            return "Category name already exists!";
        }

        $query = "INSERT INTO categories (name) VALUES('$name')";
        $inserted = $this->db->insert($query);
        if ($inserted) {
            $this->db->close();
            header("Location: list-category.php");
            exit;
        } else {
            $this->db->close();
            return "Category addition failed!";
        }
    }

    // List all Categories
    public function listCategories(){
        $query = "SELECT * FROM categories";
        $category = $this->db->selectAll($query);
        if($category){
            // $this->db->close();
            return $category;
        }else{
            $this->db->close();
            return "Category listing failed!";
        }
    }

    // Update Category
    public function updateCategory($data){
        $name = $this->format->sanitize($data['category-name']);
        $id = $this->format->sanitize($data['category-id']);

        // Check if name is empty
        if (empty($name) || empty($id)) {
            return "Category name is required!";
        }

        // Check if name exists
        $queryName = "SELECT * FROM categories WHERE name = '$name'";
        $resultName = $this->db->select($queryName);
        if ($resultName) {
            $this->db->close();
            return "Category name already exists!";
        }

        $query = "UPDATE categories SET name = '$name' WHERE id = '$id'";
        $inserted = $this->db->update($query);
        if ($inserted) {
            $this->db->close();
            header("Location: list-category.php");
            exit;
        } else {
            $this->db->close();
            return "Category update failed!";
        }

    }
    // Select Data
    public function selectData($date)
    {
        $id = $this->format->sanitize($date['id']);
        $queryId = "SELECT * FROM categories WHERE id = '$id'";
        $resultId = $this->db->select($queryId);
        if (!$resultId) {
            $this->db->close();
            exit;
        }
        return $resultId;
    }

    // Delete Category
    public function deleteCategory($id)
    {
       
            $query = "DELETE FROM categories WHERE id = '$id'";
            $deleted = $this->db->delete($query);
            if($deleted){
                $this->db->close();
                header("Location: list-category.php");
                exit;
            }else{
                $this->db->close();
                return "Category deletion failed!";
            }
        
    }
}
