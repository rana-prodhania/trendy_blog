<?php
include_once './layouts/head.php';
include_once '../classes/Post.php';
$post = new Post();

include_once '../helpers/Format.php';
$format = new Format();

$posts = $post->getAllPost();
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $category->deleteCategory($id);
}
?>
<!-- Vendors CSS -->
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/r-2.5.0/datatables.min.css" rel="stylesheet">
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
                      <th>id</th>
                      <th>Post title</th>
                      <th>Category</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($posts) {

                      while ($row = $posts->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td>
                            <?php echo $row['id']; ?>
                          </td>
                          <td>
                            <?php echo $row['title']; ?>
                          </td>
                          <td>
                            <?php echo $row['category_name']; ?>
                          </td>
                          <td class="text-center">

                            <a data-bs-toggle="modal" data-bs-target="#quickView-<?php echo $row['id']; ?>"
                              class="btn btn-sm btn-outline-info" href="http://"><i class=" fs-5 bx bx-glasses"></i></a>
                            <a class="btn btn-sm btn-outline-primary" href="edit-category.php?id=<?php echo $row['id']; ?>">
                              <i class="fs-5 bx bx-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-danger" href="?id=<?php echo $row['id']; ?>"
                              onclick="return confirm('Are you sure you want to delete?')"><i
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

<!-- <div class="card mb-4">
  <div class="card-body">
    <?php
    if ($posts) {
      foreach ($posts as $row) { ?>
        <div class="modal fade" id="quickView-<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="table-responsive">
                  <table id="example" class="table table-striped">
                    <tbody>
                      <tr>
                        <td><label for="">Post title</label></td>
                        <td>
                          <?php echo $row['title']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td><label for="">Category</label></td>
                        <td>
                          <?php echo $row['category_name']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td><label for="">Image</label></td>
                        <td>
                          <img src="uploads/post-img/<?php echo $row['image']; ?>" alt="" class="img-fluid">
                        </td>
                      </tr>
                      <tr>
                        <td><label for="">Description</label></td>
                        <td>
                          <?php echo $format->textShorten($row['description'], 100); ?>
                        </td>
                      </tr>
                      <tr>
                        <td><label for="">Type</label></td>
                        <td>
                          <?php echo ($row['type'] == 1) ? "Post" : "Slider"; ?>
                        </td>
                      </tr>
                      <tr>
                        <td><label for="">Tag</label></td>
                        <td>
                          <?php echo $row['tag']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td><label for="">Status</label></td>
                        <td>
                          <?php echo ($row['status'] == 1) ? "Publish" : "Draft"; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

              </div>
            </div>
          </div>
        </div>
        <?php
      }
    }
    ?>
  </div>
</div> -->

<!-- JavaScript -->
<?php include_once './layouts/script.php'; ?>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/r-2.5.0/datatables.min.js"></script>
<script>$(document).ready(function () { $('#example').DataTable(); });</script>
</body>
</html>