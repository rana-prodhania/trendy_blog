<?php
$realPath = dirname(__FILE__);
require_once $realPath . './../lib/Database.php';
require_once $realPath . './../helpers/Helper.php';
class Comment
{
  private $db;
  private $helper;

  public $error = [];
  public $success = []; 


  public function __construct()
  {
    $this->db = new Database();
    $this->helper = new Helper();
  }

  // add comment
  public function addComment($slug,$data)
  {
    try {
      $name = $this->helper->sanitize($data['name']);
      $email = $data['email'];
      $message = $data['message'];
      $post_id = $data['post_id']??'';

      $this->validateField($message, 'message', 'Comment is required');
      $this->validateField($name, 'name', 'Name is required');
      $this->validateField($email, 'email', 'Email is required');
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->error['email'] = 'Invalid email format';
        return;
      }
      
      

      $query = "INSERT INTO comments (name, email, message, post_id ) VALUES(:name, :email, :message, :post_id)";
      $params = [
        ':name' => $name,
        ':email' => $email,
        ':message' => $message,
        ':post_id' => $post_id,
      ];
      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Comment not added");
      }
      return $this->success['message'] = 'Comment added successfully';
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
  // get all comments
  public function getAllCommentsAdmin()
  {
    try{
      $query = "SELECT * FROM comments";
      $result = $this->db->query($query);
      if (!$result) {
        throw new Exception("Comments not found");
      }
      return $result;
    }catch(Exception $e){
      return $e->getMessage();
    }
  }
  // get all comments
  public function getAllComments($postID)
  {
    try{
      $query = "SELECT * FROM comments WHERE status = 1 AND post_id = ? ORDER BY id DESC";  
      $result = $this->db->query($query, [$postID])->fetchAll(PDO::FETCH_ASSOC);
      
      return $result;
    }catch(Exception $e){
      return $e->getMessage();
    }
  }
  // get comment by id
  public function getCommentById($id)
  {
    try {
      $query = "SELECT * FROM comments WHERE id = ?";
      $result = $this->db->query($query, [$id])->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        throw new Exception("Comment not found");
      }
      return $result;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
  // activate comment
  public function activateComment($id)
  {
    try {
      $query = "UPDATE comments SET status = 1 WHERE id = ?";
      $result = $this->db->query($query, [$id]);
      if (!$result) {
        throw new Exception("Failed to activate comment");
      }
      $_SESSION['success'] = "Comment activated successfully";
      $this->helper->redirect('comments.php');
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  // deactivate comment
  public function deactivateComment($id)
  {
    try {
      $query = "UPDATE comments SET status = 0 WHERE id = ?";
      $result = $this->db->query($query, [$id]);
      if (!$result) {
        throw new Exception("Failed to deactivate comment");
      }
      $_SESSION['success'] = "Comment deactivated successfully";
      $this->helper->redirect('comments.php');
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }
  //update comment reply
  public function updateCommentReply($id, $data)
  {
    try {
      $reply = $this->helper->sanitize($data['reply']);

      $this->validateField($reply, 'reply', 'Comment reply is required');
      
      $query = "UPDATE comments SET reply = :reply WHERE id = :id";
      $params = [
        ':reply' => $reply,
        ':id' => $id,
      ];
      $result = $this->db->query($query, $params);
      if (!$result) {
        throw new Exception("Failed to update comment reply");
      }
      $_SESSION['success'] = "Comment reply updated successfully";
      $this->helper->redirect('comments.php');
      return $result;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  // get comment reply
  public function getCommentReply($id)
  {
    try {
      $query = "SELECT reply FROM comments WHERE id = ?";
      $result = $this->db->query($query, [$id])->fetch(PDO::FETCH_ASSOC);
      if (!$result) {
        throw new Exception("Comment reply not found");
      }
      return $result;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  
  // delete comment
  public function deleteComment($id)
  {
    try {
      $query = "DELETE FROM comments WHERE id = ?";
      $result = $this->db->query($query, [$id]);
      if (!$result) {
        throw new Exception("Failed to delete comment");
      }
      $_SESSION['success'] = "Comment deleted successfully";
      $this->helper->redirect('comments.php');
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  // Validate Field
  private function validateField($field, $errorKey, $errorMessage)
  {
    if (empty($field)) {
      $this->error[$errorKey] = $errorMessage;
      throw new Exception($errorMessage);
    }
  }

}