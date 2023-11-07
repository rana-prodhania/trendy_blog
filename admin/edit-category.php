<?php
$title = "Edit Category";
include_once('./layouts/head.php');

$category = new Category();
if (isset($_GET['id'])) {
  $category_id = $category->getCategory($_GET);
}

if (isset($_POST['submit'])) {
  $result = $category->updateCategory($_POST);
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
                  <h5 class="mb-0">Edit Category</h5>
                  <a href="./categories.php" class="btn btn-sm btn-outline-primary">Back</a>
                </div>
                <div class="card-body">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="category-name" class="form-label">Category Name</label>
                      </div>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="category-name" id="category-name" placeholder="E.g. বিশ্ব"
                          value="<?php echo $_POST['category-name']??$category_id['name']; ?>" />
                        <input class="d-none" type="text" name="category-id" value="<?php echo $category_id['id']; ?>">
                        
                          <span class="text-danger">
                            <?php echo $result??"" ?>
                          </span>
                        
                      </div>
                    </div>

                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">
                          Update
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
      <!-- / Content -->
    </div>
    <!-- / Layout page -->
  </div>
</div>

<!-- JavaScript -->
<?php include_once './layouts/script.php'; ?>
</body>
</html>