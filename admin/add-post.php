<?php
include_once './layouts/head.php';
include_once '../classes/Post.php';
include_once '../classes/Category.php';

$post = new Post();
$category = new Category();
$categories = $category->getAllCategories();

if (isset($_POST['submit'])) {

  $result = $post->addPost($_POST, $_FILES);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="">
<link rel="stylesheet" href="./assets/css/style.css">
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
                          <input type="text" class="form-control" name="title" id="validationCustom03"
                            placeholder="Post title" />

                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label for="defaultSelect" class="form-label">Choose Category</label>
                        </div>
                        <div class="col-sm-10">
                          <select id="defaultSelect" name="category-id" class="form-select select2" aria-label="Default select example">
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
                          <input data-height="300"  data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png webp" class="form-control dropify" name="image" type="file"
                            id="formFile">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label class="form-label">Post Description</label>
                        </div>
                        <div class="col-sm-10 h-100">
                          <textarea name="description" id="description" cols="30" rows="10"></textarea>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label id="post-status" class="form-label">Post status</label>
                        </div>
                        <div class="col-sm-10">
                          <select id="post-status" name="status" class="form-select">
                            <option selected disabled>Select Post Status</option>
                            <option value="1">Draft</option>
                            <option value="0">Published</option>
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
  <?php include_once './layouts/script.php'; ?>
  <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function () {
      ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
          console.error(error);
        });
      $('.dropify').dropify();
      $('.select2').select2();

    })
  </script>
</body>

</html>