<?php
require_once '../lib/Database.php';
include_once '../lib/MessageHandler.php';
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

    // Add Category
    public function addCategory($data)
    {
        $name = $this->format->sanitize($data['category-name']);

        // Check if name is empty
        if (empty($name)) {
            return "Category name is required!";
        }

        // Generate slug
        $slug = $this->generateSlug($name);

        // Check if category exists
        $query = "SELECT * FROM categories WHERE slug = ?";
        $stmt = $this->db->query($query, [$slug]);
        if ($stmt->rowCount() > 0) {
            return "Category name already exists!";
        }
        

        $query = "INSERT INTO categories (name, slug) VALUES (?,?)";
        $result = $this->db->query($query, [$name, $slug]);
        return $result ? header("Location: category.php") : "Category add failed!";
        
    }

    // Update Category
    public function updateCategory($data)
    {
        $name = $this->format->sanitize($data['category-name']);
        $id = $this->format->sanitize($data['category-id']);

        // Check if name is empty
        if (empty($name)) {
            return "Category name is required!";
        }

        // Generate slug
        $slug = $this->generateSlug($name);

        // Check if name exists
        $query = "SELECT * FROM categories WHERE slug = ?";
        $stmt = $this->db->query($query, [$slug]);
        if ($stmt->rowCount() > 0) {
            return "Category name already exists!";
        }

        $query = "UPDATE categories SET name = ?, slug = ? WHERE id = ?";
        $result = $this->db->query($query, [$name, $slug, $id]);
        return $result ? header("Location: category.php") : "Category update failed!";

    }

     // Get all Categories
     public function getAllCategories()
     {
         $query = "SELECT * FROM categories ORDER BY id DESC";
         return $this->db->query($query) ?? "Category not found!";
     }
 
     // Get a Category
     public function getCategory($data)
     {
        $id = $this->format->sanitize($data['id']);
        $query = "SELECT * FROM categories WHERE id = ?";
        $result = $this->db->query($query, [$id]);
        $result= $result->fetch(PDO::FETCH_ASSOC);
        return $result ?? "Category not found!";
     }
 
     // Delete Category
     public function deleteCategory($id)
     {
         $query = "DELETE FROM categories WHERE id = ?";
         $stmt = $this->db->query($query, [$id]);
         return $stmt ? header("Location: category.php") : "Category delete failed!";
     }

    //  Generate slug
    public function generateSlug($name)
    {
        $slug = trim(preg_replace('/[^a-z0-9-]+/', '-', strtolower($name)), '-');
        return $slug;
    }
    
}