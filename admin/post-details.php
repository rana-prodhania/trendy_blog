<?php
include_once './layouts/head.php';
include_once '../classes/Post.php';

$post = new Post();

if($_GET['id']){
  $id = $_GET['id'];
  $result = $post->getPost($id);
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
                  <h5 class="mb-0">Post Details</h5>
                  <a href="posts.php" class="btn btn-sm btn-outline-danger">Back</a>
                </div>
                <div class="card-body">
                  <h5><?php echo $result['category_name']; ?></h5>
                  <h3><?php echo $result['title']; ?></h3>
                  <p><?php echo $result['author']; ?></p>
                  <div class="text-center">
                  <img src="uploads/post-img/<?php echo $result['image']; ?>" alt="" srcset="" class="img-fluid w-50">
                  </div>
                  <p><?php echo $result['description']; ?></p>
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