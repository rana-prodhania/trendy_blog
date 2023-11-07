<?php
$title = "Post Details";
include_once './layouts/head.php';

$commentObj = new Comment();
if ($_GET['id']) {
  $id = $_GET['id'];
  $comment = $commentObj->getCommentById($id);
};
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
                    <h5 class="mb-0">Post Details</h5>
                    <a href="comments.php" class="btn btn-sm btn-outline-danger">Back</a>
                  </div>
                  <div class="card-body">
                    <p>Name:
                      <?php echo $comment['name']; ?>
                    </p>
                    <p>Email:
                      <?php echo $comment['email']; ?>
                    </p>
                    <p>
                      Message:
                      <?php echo $comment['message']; ?>
                    </p>
                    <p>
                      Reply:
                      <?php echo $comment['reply']; ?>
                    </p>
                    <p>
                      Date:
                      <?php echo $comment['created_at']; ?>
                    </p>
                    <p>Status:
                      <?php echo $comment['status'] == 1 ? 'Active' : 'Inactive'; ?>
                    </p>
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