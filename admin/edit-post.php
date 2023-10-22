<?php
include_once './layouts/head.php';
include_once '../classes/Post.php';
include_once '../classes/Category.php';
include_once '../classes/Tag.php';

$post = new Post();
$category = new Category();
$tag = new Tag();
$categories = $category->getAllCategories();
$tags = $tag->getAllTagsAdmin();

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result1 = $post->getPostAdmin($id);
}

if (isset($_POST['submit'])) {
  $result = $post->updatePost($_POST, $_FILES);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.css" />
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
                    <h5 class="mb-0">Edit Post</h5>
                    <a href="./posts.php" class="btn btn-sm btn-outline-primary">Back</a>
                  </div>
                  <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="post-id" value="<?php echo $result1['id']; ?>" />
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label for="validationCustom03" class="form-label">Post Title</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="post-title"
                            value="<?php echo $result1['title']; ?>" id="validationCustom03" placeholder="Post title" />

                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label for="defaultSelect" class="form-label">Choose Category</label>
                        </div>
                        <div class="col-sm-10">
                          <select id="defaultSelect" name="category-id" class="form-select select2"
                            aria-label="Default select example">
                            <?php foreach ($categories as $category):?>
                              <option <?php echo $result1['category_id'] == $category['id'] ? 'selected' : '';?>
                                value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label for="formFile" class="form-label">Post Image</label>
                        </div>
                        <div class="col-sm-10">
                          <input data-default-file="uploads/post-img/<?php echo $result1['image']; ?>" data-height="300" data-max-file-size="1M"
                            data-allowed-file-extensions="jpg jpeg png webp" class="form-control dropify"
                            name="post-image" type="file" id="formFile">
                            <input type="hidden" name="old-image" value="<?php echo $result1['image']; ?>" />
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label class="form-label">Post Description</label>
                        </div>
                        <div class="col-sm-10 h-100">
                          <textarea name="description" id="description" cols="30" rows="10"><?php echo $result1['description'];?></textarea>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label id="post-status" class="form-label">Post status</label>
                        </div>
                        <div class="col-sm-10">
                          <select id="post-status" name="status" class="form-select">
                            <option selected disabled>Select Post Status</option>
                            <?php if ($result1['status'] == 1): ?>
                              <option value="1" selected>Publish</option>
                              <option value="0">Draft</option>
                            <?php else: ?>
                              <option value="1">Publish</option>
                              <option value="0" selected>Draft</option>
                            <?php endif; ?>
                          </select>
                        </div>
                      </div>

                      <div class="row justify-content-end">
                        <div class="col-sm-10">
                          <button type="submit" name="submit" class="btn btn-primary">
                            Update Post
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.js"></script>
  <script>
    $(document).ready(function () {
      ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
          console.error(error);
        });
      $('.dropify').dropify();
      $('.select2').select2();
      const input = document.querySelector('input[name=tag-name]');
      new Tagify(input);

    })
  </script>
</body>

</html>