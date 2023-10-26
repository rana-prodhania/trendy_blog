<?php
$realPath = dirname(__FILE__);
require_once $realPath . './../lib/Database.php';
require_once $realPath . './../helpers/Helper.php';

class Post
{
  private $db;
  private $helper;

  public $error = [];

  public function __construct()
  {
    $this->db = new Database();
    $this->helper = new Helper();

  }
  // Add Post
  public function addPost($data, $files)
  {
    try {
      $admin_id = $_SESSION['id'];
      $title = $this->helper->sanitize($data['post-title']);
      $category_id = $data['category-id'] ?? "";
      $image = $files['post-image'];
      $description = $data['description'];
      $status = $data['status'];

      if (empty($title) || empty($category_id) || empty($image) || empty($description)) {
        throw new Exception("All fields are required!");
      }

      $slug = $this->helper->generateSlug($title);
      $image = $this->uploadImage($image);

      $query = "INSERT INTO posts (title, category_id, image, description, status, admin_id, slug) VALUES (:title, :category_id, :image, :description, :status, :admin_id, :slug)";
      $params = [
        ':title' => $title,
        ':category_id' => $category_id,
        ':image' => $image,
        ':description' => $description,
        ':status' => $status,
        ':admin_id' => $admin_id,
        ':slug' => $slug
      ];

      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Post addition failed!");
      }

      $_SESSION['success'] = "Post added successfully!";
      $this->helper->redirect("posts.php");
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
  // Update Post
  public function updatePost($data, $files)
  {
    try {
      $id = $data['post-id'];
      $admin_id = $_SESSION['id'];
      $title = $this->helper->sanitize($data['post-title']);
      $category_id = $data['category-id'] ?? "";
      $image = $files['post-image'];
      $oldImage = $data['old-image'];
      $description = $data['description'];
      $status = $data['status'];

      // Check if a new image is provided
      if (isset($files['post-image']['name']) && !empty($files['post-image']['name'])) {
        // Get the old image path
        $post = $this->getPostAdmin($id);
        $oldImage = 'uploads/post-img/' . $post['image'];

        // Delete the old image
        if (file_exists($oldImage)) {
          unlink($oldImage);

          // Upload the new image
          $image = $this->uploadImage($image);
        }
      } else {
        $image = $oldImage;
      }

      if (empty($title) || empty($category_id) || empty($description)) {
        throw new Exception("All fields are required!");
      }

      $slug = $this->helper->generateSlug($title);


      $query = "UPDATE posts SET title = :title, category_id = :category_id, image = :image, description = :description, status = :status, admin_id = :admin_id, slug = :slug WHERE id = :id";
      $params = [
        ':title' => $title,
        ':category_id' => $category_id,
        ':image' => $image,
        ':description' => $description,
        ':status' => $status,
        ':admin_id' => $admin_id,
        ':slug' => $slug,
        ':id' => $id
      ];

      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Post addition failed!");
      }

      $_SESSION['success'] = "Post added successfully!";
      $this->helper->redirect("posts.php");
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  // Get All Post Admin
  public function getAllPostAdmin()
  {
    try {
      $query = "SELECT posts.id, posts.title,posts.status, categories.name  as category_name FROM posts INNER JOIN categories ON posts.category_id = categories.id ORDER BY posts.id DESC";
      $statement = $this->db->query($query);
      return $statement ?? "Post not found!";
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }


  // Get a Post for Admin
  public function getPostAdmin($id)
  {
    try {
      // join table posts and categories,admin to get category name and admin name
      $query = "SELECT posts.*, categories.name as category_name, admins.name as author FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN admins ON posts.admin_id = admins.id WHERE posts.id = ?";

      $statement = $this->db->query($query, [$id]);
      return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
  // Get a Post for Frontend
  public function getPost($slug)
  {
    try {
      // join table posts and categories,admin to get category name and admin name
      $query = "SELECT posts.*, categories.name as category_name, admins.name as author FROM posts INNER JOIN categories ON posts.category_id = categories.id INNER JOIN admins ON posts.admin_id = admins.id WHERE posts.slug = ? ";

      $statement = $this->db->query($query, [$slug]);
      return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  // Get Post By Category with Pagination
  public function getPostByCategory($slug, $limit = 1)
  {
    try {
      $selectCategoryId = "SELECT id FROM categories WHERE slug = ?";
      $id = $this->db->query($selectCategoryId, [$slug])->fetchColumn();

      $page = isset($_GET['page']) ? $_GET['page'] : 1;

      $countQuery = "SELECT COUNT(*) FROM posts WHERE status = 1 AND category_id = ?";
      $totalPost = $this->db->query($countQuery, [$id])->fetchColumn();

      if (!$totalPost) {
        return ['totalPage' => 0, 'data' => [], 'page' => $page, 'message' => 'No post found in this category!'];
      }

      $totalPage = ceil($totalPost / $limit);
      $start = ($page - 1) * $limit;

      $query = "SELECT posts.title, posts.slug, posts.image, posts.created_at, categories.name AS category_name
              FROM posts 
              INNER JOIN categories ON posts.category_id = categories.id 
              
              WHERE posts.status = 1 
              AND posts.category_id = ?
              ORDER BY posts.id DESC 
              LIMIT $start, $limit";

      $posts = $this->db->query($query, [$id])->fetchAll(PDO::FETCH_ASSOC);

      return ['totalPage' => $totalPage, 'data' => $posts, 'page' => $page];
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }



  // Search Post with keyword and pagination
  public function searchPost($keyword, $limit = 1)
  {
    try {
      $page = $_GET['page'] ?? 1;

      $countQuery = "SELECT COUNT(*) FROM posts WHERE status = 1 AND (title LIKE :keyword OR description LIKE :keyword)";
      $params = [
        ':keyword' => '%' . $keyword . '%'
      ];
      $totalPost = $this->db->query($countQuery, $params)->fetchColumn();
      if (!$totalPost) {
        return ['totalPage' => 0, 'data' => [], 'page' => $page, 'message' => 'No post found!'];
      }
      $totalPage = ceil($totalPost / $limit);
      $start = ($page - 1) * $limit;

      $query = "SELECT posts.title, posts.slug, posts.image, posts.created_at, categories.name AS category_name, categories.slug as category_slug 
              FROM posts 
              INNER JOIN categories ON posts.category_id = categories.id 
              WHERE posts.status = 1 
              AND (posts.title LIKE :keyword OR posts.description LIKE :keyword) 
              ORDER BY posts.id DESC 
              LIMIT $start, $limit";

      $posts = $this->db->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);

      return ['totalPage' => $totalPage, 'data' => $posts, 'page' => $page];

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }



  // Get All Post With Pagination
  public function getAllPost($limit)
  {
    try {
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $countQuery = "SELECT COUNT(*) FROM posts WHERE status = 1";
      $totalPost = $this->db->query($countQuery)->fetchColumn();

      if (!$totalPost) {
        return ['totalPage' => 0, 'data' => [], 'page' => $page, 'message' => 'No post found!'];
      }

      $totalPage = ceil($totalPost / $limit);

      $start = ($page - 1) * $limit;

      $selectQuery = "SELECT posts.title, posts.slug, posts.image, posts.created_at, categories.name AS category_name,  categories.slug as category_slug
            FROM posts
            INNER JOIN categories ON posts.category_id = categories.id
            
            WHERE posts.status = 1
            ORDER BY updated_at DESC LIMIT $start, $limit";

      $posts = $this->db->query($selectQuery)->fetchAll(PDO::FETCH_ASSOC);

      return ['totalPage' => $totalPage, 'data' => $posts, 'page' => $page];
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  // Get All Featured Post
  public function getAllFeaturedPost($limit = 1)
  {
    try {
      $selectQuery = "SELECT posts.image, posts.title, posts.slug, posts.created_at, categories.name as category_name, categories.slug as category_slug FROM posts
              INNER JOIN categories ON posts.category_id = categories.id
              WHERE posts.status = 1 AND posts.is_featured = 1
              ORDER BY updated_at DESC LIMIT $limit";

      $posts = $this->db->query($selectQuery)->fetchAll(PDO::FETCH_ASSOC);

      return $posts;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  // Get All Popular Post
  public function getAllPopularPost($limit = 3)
  {
    try {
      $selectQuery = "SELECT posts.image, posts.title, posts.slug, posts.created_at FROM posts
              
              WHERE posts.status = 1
              ORDER BY RAND() LIMIT $limit";

      $posts = $this->db->query($selectQuery)->fetchAll(PDO::FETCH_ASSOC);
      if (empty($posts)) {
        throw new Exception("No post found!");
      }
      return $posts;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }


  // Delete Post
  public function deletePost($id)
  {
    try {
      $post = $this->getPostAdmin($id);
      $imagePath = 'uploads/post-img/' . $post['image'];

      $query = "DELETE FROM posts WHERE id = ?";
      $result = $this->db->query($query, [$id]);
      if (!$result) {
        throw new Exception("Post deletion failed!");
      }

      // Delete the associated image file
      if (file_exists($imagePath)) {
        unlink($imagePath);
      }

      $_SESSION['success'] = "Post deleted successfully!";
      $this->helper->redirect("posts.php");
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  // Upload Image
  public function uploadImage($image, $previousImage = null)
  {
    $image_name = $image['name'];
    $image_temp = $image['tmp_name'];
    $image_error = $image['error'];

    if ($image_error !== 0) {
      return 'Error: File upload error: ' . $image_error;
    }

    $allowed_exs = array('jpg', 'jpeg', 'png', 'webp');
    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_ex_lc = strtolower($image_ex);

    if (!in_array($image_ex_lc, $allowed_exs)) {
      return 'Error: Invalid file type';
    }

    $image_new_name = uniqid('IMG-', true) . '.' . $image_ex_lc;
    $image_upload_path = 'uploads/post-img/' . $image_new_name;

    if (!move_uploaded_file($image_temp, $image_upload_path)) {
      return 'Error: Failed to move the uploaded file';
    }

    // If a previous image path is provided, delete the previous image.
    if ($previousImage && file_exists($previousImage)) {
      unlink($previousImage);
    }

    return $image_new_name;
  }

}