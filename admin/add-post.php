<?php
include_once('./inc/head.php');
include '../classes/Post.php';
include '../classes/Category.php';

$post = new Post();
$categories = new Category();
$categories = $categories->listCategories();

if (isset($_POST['submit'])) {

  $result = $post->addPost($_POST, $_FILES);
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

      <!-- Content -->
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

              <!-- Register -->
              <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="mb-0">Add Post</h5>
                  <a href="./index-post.php" class="btn btn-sm btn-outline-primary">Back</a>
                </div>
                <div class="card-body">
                  <form action="" method="POST" enctype="multipart/form-data">

                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="validationCustom03" class="form-label">Post Title</label>
                      </div>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="post-title" id="validationCustom03"
                          placeholder="Post title" />

                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="defaultSelect" class="form-label">Choose Category</label>
                      </div>
                      <div class="col-sm-10">
                        <select id="defaultSelect" name="category-id" class="form-select">
                          <option disabled selected>Select Category</option>
                          <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['id']; ?>">
                              <?php echo $category['name']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="formFile" class="form-label">Post Image</label>
                      </div>
                      <div class="col-sm-10">
                        <input class="form-control" name="post-image" type="file" id="formFile">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label class="form-label">Post Content</label>
                      </div>
                      <div class="col-sm-10 h-100">
                        <textarea name="description" id="description" cols="30" rows="10"></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="defaultSelect" class="form-label">Post Type</label>
                      </div>
                      <div class="col-sm-10">
                        <select id="defaultSelect" name="post-type" class="form-select">
                          <option selected disabled>Select Post Type</option>
                          <option value="2">Slider</option>
                          <option value="1">Post</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="validationCustom03" class="form-label">Post Tag</label>
                      </div>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="post-tag" id="validationCustom03"
                          placeholder="Post tag" />
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="defaultSelect" class="form-label">Post status</label>
                      </div>
                      <div class="col-sm-10">
                        <select id="defaultSelect" name="post-status" class="form-select">
                          <option selected disabled>Select Post Status</option>
                          <option value="2">Draft</option>
                          <option value="1">Published</option>
                        </select>
                      </div>
                    </div>

                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">
                          Add Post
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
<?php include_once './inc/script.php'; ?>