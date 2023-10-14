<?php

require_once '../lib/Database.php';
require_once '../helpers/Format.php';

class Post
{
  private $db;
  private $format;

  public function __construct()
  {
    $this->db = new Database();
    $this->format = new Format();

  }
  // Add Post
  public function addPost($data, $files)
  {
    $title = $this->format->sanitize($data['post-title']);
    $category_id = $data['category-id'] ?? "";
    $image = $files['post-image'];
    $description = $data['description'];
    $type = $data['post-type'] ?? "1";
    $tag = $this->format->sanitize($data['post-tag']);
    $status = $data['post-status'] ?? "1";

    // Check if all fields is empty
    if (!empty($title) && !empty($category_id) && !empty($image) && !empty($description) && !empty($type) && !empty($tag)) {
      // Image upload
      $image = $this->uploadImage($image);
      $query = "INSERT INTO posts (title, category_id, image, description, type, tag, status) 
             VALUES ('$title', '$category_id', '$image', '$description', '$type', '$tag', '$status')";
      $inserted = $this->db->insert($query);

      if ($inserted) {
        $this->db->close();
        header("Location: index-post.php");
        exit;
      } else {
        $this->db->close();
        return "Post addition failed!";
      }

    } else {
      return "All fields are required!";
    }
  }
  // Upload Image
  public function uploadImage($image)
  {
    $image_name = $image['name'];
    $image_temp = $image['tmp_name'];
    $image_error = $image['error'];

    if ($image_error === 0) {
      $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
      $image_ex_lc = strtolower($image_ex);
      $allowed_exs = array('jpg', 'jpeg', 'png');

      if (in_array($image_ex_lc, $allowed_exs)) {
        $image_new_name = uniqid('IMG-', true) . '.' . $image_ex_lc;
        $image_upload_path = 'uploads/post-img/' . $image_new_name;
        move_uploaded_file($image_temp, $image_upload_path);
        return $image_new_name;
      }
    }
  }
  // Get All Post
  public function getAllPost()
  {
    // Join table posts and categories
    $query = "SELECT posts.*, categories.name AS category_name FROM posts JOIN categories ON posts.category_id = categories.id ORDER BY posts.id DESC";
    $posts = $this->db->selectAll($query);
    if ($posts) {
      // $this->db->close();
      return $posts;
    } else {
      $this->db->close();
      return "Post listing failed!";
    }
  }

}