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
        try {
            $name = $this->format->sanitize($data['category-name']);



            if (empty($name)) {
                throw new Exception("Category name is required!");
            }


            if (!preg_match('/^(?=.*[\p{Bengali}a-zA-Z])[a-zA-Z0-9\-\p{Bengali} ]+$/u', $name)) {
                throw new Exception("Category name should only contain letters, numbers, and hyphens.");
            }

            if (strlen($name) < 3 || strlen($name) > 80) {
                throw new Exception("Category name should be between 3 and 80 characters.");
            }


            $slug = $this->generateSlug($name);

            if ($this->doesCategoryExist($slug)) {
                throw new Exception("Category name already exists!");
            }

            $query = "INSERT INTO categories (name, slug) VALUES (?, ?)";
            $result = $this->db->query($query, [$name, $slug]);

            if (!$result) {
                throw new Exception("Category addition failed!");
            }
            $_SESSION['success'] = "Category added successfully!";
            header("Location: categories.php");
            exit;
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    // Update Category
    public function updateCategory($data)
    {
        try {
            $name = $this->format->sanitize($data['category-name']);
            $id = $this->format->sanitize($data['category-id']);


            // Check if name is empty
            if (empty($name)) {
                throw new Exception("Category name is required!");
            }

            // Generate slug
            $slug = $this->generateSlug($name);

            // Check if name exists
            if ($this->doesCategoryExist($slug)) {
                throw new Exception("Category name already exists!");
            }

            $query = "UPDATE categories SET name = ?, slug = ? WHERE id = ?";
            $result = $this->db->query($query, [$name, $slug, $id]);
            if (!$result) {
                throw new Exception("Category update failed!");
            }
            $_SESSION['success'] = "Category updated successfully!";
            header("Location: categories.php");
            exit;
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    // Get all Categories
    public function getAllCategories()
    {
        try {
            $query = "SELECT * FROM categories ORDER BY id DESC";
            $statement = $this->db->query($query);
            return $statement ?? "Category not found!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Get a Category
    public function getCategory($data)
    {
        try {
            $id = $this->format->sanitize($data['id']);
            $query = "SELECT * FROM categories WHERE id = ?";
            $result = $this->db->query($query, [$id])->fetch(PDO::FETCH_ASSOC);
            return $result ?? "Category not found!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Delete Category
    public function deleteCategory($id)
    {
        try {
            $query = "DELETE FROM categories WHERE id = ?";
            $result = $this->db->query($query, [$id]);
            if (!$result) {
                throw new Exception("Category deletion failed!");
            }
            header("Location: categories.php");
            exit;
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    // Check if category exists
    private function doesCategoryExist($slug)
    {
        try {
            $query = "SELECT * FROM categories WHERE slug = ?";
            $result = $this->db->query($query, [$slug])->fetch(PDO::FETCH_ASSOC);
            return $result ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    //  Generate slug
    public function generateSlug($name)
    {
        $slug = trim(preg_replace('/[^a-zA-Z0-9\p{Bengali}-]+/u', '-', strtolower($name)), '-');
        return $slug;
    }

}