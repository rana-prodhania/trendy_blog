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
    $title = $this->format->sanitize($data['title']);
    $category_id = $data['category-id'] ?? "";
    $image = $files['image'];
    $description = $data['description'];
    $status = $data['status'];

    // Check if all fields is empty
    if (!empty($title) && !empty($category_id) && !empty($image) && !empty($description) && !empty($type) && !empty($tag)) {
      // Image upload
      $image = $this->uploadImage($image);
      $query = "INSERT INTO posts (title, category_id, image, description, status) 
             VALUES ('$title', '$category_id', '$image', '$description',   '$status')";
      $inserted = $this->db->query($query);

      if ($inserted) {
        header("Location: posts.php");
        exit;
      } else {
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
    $query = "SELECT posts.id, posts.title, categories.name as category_name
              FROM posts 
              INNER JOIN categories ON posts.category_id = categories.id";
    $posts = $this->db->query($query) ?? "Post listing failed!";
    return $posts;
  }
  

}