<?php
include_once './layouts/head.php';
include_once '../classes/Tag.php';

$tag = new Tag();

if (isset($_POST['submit'])) {
   $result = $tag->addTag($_POST);

}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.css" />
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
                  <h5 class="mb-0">Add Tag</h5>
                  <a href="tags.php" class="btn btn-sm btn-outline-danger">Back</a>
                </div>
                <div class="card-body">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label for="tag-name" class="form-label">Tag Name</label>
                      </div>
                      <div class="col-sm-10">
                      <input type="text" class="form-control" name='tag-name' autofocus id="post-tag"
                            placeholder="Post tag" />
                        <!-- Error Message -->
                        <?php
                        if (isset($result)) {
                          ?>
                          <div class="text-danger">
                            <?php echo $result; ?>
                          </div>
                        <?php } ?>
                      </div>
                    </div>

                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">
                          Add Tag
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.9/tagify.min.js"></script>
<script>const input = document.querySelector('input[name=tag-name]');
      new Tagify(input);</script> 
</body>
</html>