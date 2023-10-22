<?php
$realPath = dirname(__FILE__);
require_once $realPath . './../lib/Database.php';
require_once $realPath . './../helpers/Helper.php';

class Category
{
    private $db;
    private $helper;

    public function __construct()
    {
        $this->db = new Database();
        $this->helper = new Helper();
    }

    // Add Category
    public function addCategory($data)
    {
        try {
            $name = $this->helper->sanitize($data['category-name']);

            if (empty($name)) {
                throw new Exception("Category name is required!");
            }

            // Validate name
            $this->helper->validateName($name);

            // Name length
            $this->helper->nameLength($name);

            $slug = $this->helper->generateSlug($name);

            if ($this->doesCategoryExist($slug)) {
                throw new Exception("Category name already exists!");
            }

            $query = "INSERT INTO categories (name, slug) VALUES (?, ?)";
            $result = $this->db->query($query, [$name, $slug]);

            if (!$result) {
                throw new Exception("Category addition failed!");
            }

            $_SESSION['success'] = "Category added successfully!";
            $this->helper->redirect("categories.php");

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    // Update Category
    public function updateCategory($data)
    {
        try {
            $name = $this->helper->sanitize($data['category-name']);
            $id = $this->helper->sanitize($data['category-id']);

            // Check if name is empty
            if (empty($name)) {
                throw new Exception("Category name is required!");
            }

            // Validate name
            $this->helper->validateName($name);

            // Generate slug
            $slug = $this->helper->generateSlug($name);

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
            $this->helper->redirect("categories.php");
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
            $id = $this->helper->sanitize($data['id']);
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
            $this->helper->redirect("categories.php");
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
}