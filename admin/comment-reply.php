<?php
$title = "Comment Reply";
include_once './layouts/head.php';

$commentObj = new Comment();
$id = $_GET['id']??'';
$comment = $commentObj->getCommentReply($id);
if(isset($_POST['submit'])){
  $result = $commentObj->updateCommentReply($id, $_POST);
}
?>

</head>

<body>
 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
   <!-- Menu or Sidebar -->
   <?php include_once './layouts/sidebar.php'; ?>
   <!-- / Menu or Sidebar -->

   <!-- Layout container -->
   <div class="layout-page">
    <!-- Navbar -->
    <?php include_once './layouts/navbar.php'; ?>
    <!-- / Navbar -->

    <!-- Content -->
    <div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row mb-4 justify-content-center">
       <div class="col-xxl">
        <div class="card mb-4">
         <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="mb-0">Comment Reply</h5>
          <a href="./comments.php" class="btn btn-sm btn-outline-danger">Back</a>
         </div>
         <div class="card-body">
          <form action="comment-reply.php?id=<?php echo $id ?>" method="POST" >
           <div class="row mb-3">
            <div class="col-sm-2">
             <label class="form-label">Comment Reply</label>
            </div>
            <div class="col-sm-10 h-100">
             <textarea class="form-control" name="reply" id="reply" cols="30"
              rows="5"><?php echo $comment['reply'] ?? ''; ?></textarea>
              <span class="text-danger"><?php echo $result ?? ''; ?></span>
            </div>
           </div>
           <div class="row justify-content-end">
            <div class="col-sm-10">
             <button type="submit" name="submit" class="btn btn-primary">
              Submit
             </button>
            </div>
           </div>
          </form>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
   <!-- / Content -->
  </div>
  <!-- / Layout page -->
 </div>
 </div>

 <!-- JavaScript -->
 <?php include_once './layouts/script.php'; ?>

</body>

</html>