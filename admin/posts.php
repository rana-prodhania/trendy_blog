<?php
include_once './layouts/head.php';
include_once './layouts/custom-css.php';
include_once '../classes/Post.php';

$post = new Post();
$posts = $post->getAllPostAdmin();
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $post->deletePost($id);
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

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4 justify-content-center">
              <div class="col-xxl">
                <!-- Error Alert -->
                <?php
                if (isset($result)) {
                  ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $result; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php } ?>
                <!-- / Error Alert -->
                <div class="card mb-4 p-3">
                  <div class="card-header px-0 m-0 d-flex justify-content-between">
                    <div class="head-label">
                      <h5 class="card-title mb-0">
                        List of Posts
                      </h5>
                    </div>
                    <div>
                      <a href="add-post.php"><button type="button" class="btn btn-primary">
                          Add Post
                        </button></a>
                    </div>
                  </div>
                  <table id="example" class="table table-striped" style="width: 100%">
                    <thead>
                      <tr>
                        <th >S/N</th>
                        <th>Post title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($posts) {
                        $i = 1;
                        while ($row = $posts->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>
                            <td>
                              <?php echo $i++; ?>
                            </td>
                            <td>
                              <?php echo Helper::textShorten($row['title'], 40) ?>
                            </td>
                            <td>
                              <?php echo $row['category_name']; ?>
                            </td>
                            <td>
                              <?php
                              $status = $row['status'];
                              $badgeClass = ($status == 1) ? 'success' : 'danger';
                              $badgeText = ($status == 1) ? 'Published' : 'Draft';
                              ?>

                              <span class="badge rounded-pill bg-<?php echo $badgeClass; ?>">
                                <?php echo $badgeText; ?>
                              </span>
                            </td>
                            <td class="text-center">

                              <a
                                class="btn btn-sm btn-outline-info" href="post-details.php?id=<?php echo $row['id']; ?>"><i class=" fs-5 bx bx-glasses"></i></a>
                              <a class="btn btn-sm btn-outline-primary"
                                href="edit-post.php?id=<?php echo $row['id']; ?>">
                                <i class="fs-5 bx bx-edit"></i>
                              </a>
                              <a class="btn btn-sm btn-outline-danger btn-delete" href="?id=<?php echo $row['id']; ?>"><i
                                  class="fs-5 bx bx-trash"></i></a>

                            </td>
                          </tr>
                          <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Content -->

          <!-- / Content -->
        </div>
      </div>
      <!-- / Layout page -->
    </div>
  </div>

  <!-- JavaScript -->
  <?php
  include_once './layouts/script.php';
  include_once './layouts/custom-script.php';
  // check for success message 
  if (isset($_SESSION['success'])) {
    echo '<script>toastr.success("' . $_SESSION['success'] . '","Success")</script>';
    unset($_SESSION['success']);
  }
  ?>

</body>

</html>