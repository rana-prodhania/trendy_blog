<?php
$realPath = dirname(__FILE__);
require_once $realPath. './../lib/Database.php';
require_once '../helpers/Helper.php';

class Tag
{
    private $db;
    private $helper;

    public function __construct()
    {
        $this->db = new Database();
        $this->helper = new Helper();
    }

    // Add Tag
    public function addTag($data)
    {
        try {
            $jsonData = $data['tag-name'];
            $tagArray = json_decode($jsonData, true);


            if (!is_array($tagArray)) {
                throw new Exception("Invalid JSON data.");
            }

            $values = [];
            $placeholders = [];
            foreach ($tagArray as $tagData) {
                if (isset($tagData['value'])) {
                    $name = $tagData['value'];
                    $slug = $this->helper->generateSlug($name);

                    if ($this->doesTagExist($slug)) {
                        throw new Exception("Tag name '$name' already exists!");
                    }

                    $values[] = $name;
                    $values[] = $slug;
                    $placeholders[] = "(?, ?)";
                }
            }

            if (empty($values)) {
                return "No tags to add.";
            }

            $query = "INSERT INTO tags (name, slug) VALUES " . implode(", ", $placeholders);
            $result = $this->db->query($query, $values);

            if (!$result) {
                throw new Exception("Tag addition failed.");
            }
            $_SESSION['success'] = "Tag added successfully!";
            $this->helper->redirect("tags.php");
            exit;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /// Update Tag
    public function updateTag($data)
    {
        try {
            $name = $this->helper->sanitize($data['tag-name']);
            $id = $this->helper->sanitize($data['tag-id']);


            // Check if name is empty
            if (empty($name)) {
                throw new Exception("Tag name is required!");
            }

            // Generate slug
            $slug = $this->helper->generateSlug($name);

            // Check if name exists
            if ($this->doesTagExist($slug)) {
                throw new Exception("Tag name already exists!");
            }

            $query = "UPDATE tags SET name = ?, slug = ? WHERE id = ?";
            $result = $this->db->query($query, [$name, $slug, $id]);
            if (!$result) {
                throw new Exception("Tag update failed!");
            }
            $_SESSION['success'] = "Tag updated successfully!";
            $this->helper->redirect("tags.php");
            exit;
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    // Get all tags
    public function getAllTags()
    {
        try {
            $query = "SELECT * FROM tags ORDER BY id DESC";
            $statement = $this->db->query($query);
            return $statement ?? "Category not found!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Get a tag
    public function getTag($data)
    {
        try {
            $id = $data['id'];
            $query = "SELECT * FROM tags WHERE id = ?";
            $result = $this->db->query($query, [$id])->fetch(PDO::FETCH_ASSOC);
            return $result ?? "Tag not found!";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Delete tag
    public function deleteTag($id)
    {
        try {
            $query = "DELETE FROM tags WHERE id = ?";
            $result = $this->db->query($query, [$id]);
            if (!$result) {
                throw new Exception("Tag deletion failed!");
            }
            $_SESSION['success'] = "Tag deleted successfully!";
            $this->helper->redirect("tags.php");
            exit;
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    // // Check if category exists
    private function doesTagExist($slug)
    {
        try {
            $query = "SELECT * FROM tags WHERE slug = ?";
            $result = $this->db->query($query, [$slug])->fetch(PDO::FETCH_ASSOC);
            return $result ? true : false;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}