<?php
$title = "Site Settings";
include_once('./layouts/head.php');

$settingObj = new SiteSetting();
$setting = $settingObj->getSiteSetting();
if (isset($_POST['submit'])) {
$settingObj->updateSiteSetting($_POST);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
          <h5 class="mb-0">Site Settings</h5>
         </div>
         <div class="card-body">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Site title</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="site_title" id="category-name"
              value="<?php echo $setting['site_title'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Logo Text</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="logo_text" id="category-name"
              value="<?php echo $setting['logo_text'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>

           <div class="row mb-3">
            <div class="col-sm-2">
             <label class="form-label">Description</label>
            </div>
            <div class="col-sm-10 h-100">
             <textarea class="form-control" name="description" id="reply" cols="30" rows="5"><?php echo $setting['description'] ?? ''; ?></textarea>
             <span class="text-danger">
              <?php echo $result ?? ''; ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Keywords</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="keywords" id="category-name"
              value="<?php echo $setting['keywords'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Pagination</label>
            </div>
            <div class="col-sm-10">
             <input type="number" class="form-control" name="pagination" id="category-name"
              value="<?php echo $setting['pagination'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Popular Posts Per Page</label>
            </div>
            <div class="col-sm-10">
             <input type="number" class="form-control" name="pop_per_page" id="category-name"
              value="<?php echo $setting['pop_per_page'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Related Posts Per Page</label>
            </div>
            <div class="col-sm-10">
             <input type="number" class="form-control" name="rel_posts_limit" id="category-name"
              value="<?php echo $setting['rel_posts_limit'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
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