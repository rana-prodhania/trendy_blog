<?php
include_once './layouts/head.php';
include_once '../classes/Category.php';

$category = new Category();
$categories = $category->getAllCategories();
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
                      List of Categories
                    </h5>
                  </div>
                  <div>
                    <a href="add-category.php"><button type="button" class="btn btn-primary">
                        Add Category
                      </button></a>
                  </div>
                </div>
                <table id="example" class="table table-striped" style="width: 100%">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Category Name</th>
                      <th>Category slug</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($categories) {
                      $i = 1;
                      while ($row = $categories->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td>
                            <?php echo $i++; ?>
                          </td>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                          <td>
                            <?php echo $row['slug']; ?>
                          </td>
                          <td class="text-center">
                            <a class="btn btn-sm btn-outline-primary" href="edit-category.php?id=<?php echo $row['id']; ?>">
                              <i class="fs-5 bx bx-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-danger" href="?id=<?php echo $row['id']; ?>"
                              onclick="return confirm('Are you sure you want to delete?')"
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

<!-- JavaScript -->
<?php include_once './layouts/script.php'; ?>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/r-2.5.0/datatables.min.js"></script>
<script>$('#example').DataTable();</script>
</body>
</html>