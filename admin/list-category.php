<?php
include_once('./inc/head.php');
include '../classes/Category.php';

$category = new Category();
$categories = $category->listCategories();
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $category->deleteCategory($id);
}
?>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu or Sidebar -->
    <?php include_once './inc/sidebar.php'; ?>
    <!-- / Menu or Sidebar -->

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->
      <?php include_once './inc/navbar.php'; ?>
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
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($categories) {
                      while ($row = $categories->fetch_assoc()) { ?>
                        <tr>
                          <td>
                            <?php echo $row['id']; ?>
                          </td>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                          <td class="text-center">
                            <a href="edit-category.php?id=<?php echo $row['id']; ?>">
                              <button type="button" class="btn btn-sm btn-outline-primary">
                                Edit
                              </button>
                            </a>
                            <a href="?id=<?php echo $row['id']; ?>"
                              onclick="return confirm('Are you sure you want to delete?')"><button type="button"
                                class="btn btn-sm btn-outline-danger">
                                Delete
                              </button></a>
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
<?php include_once './inc/script.php'; ?>