<?php
$title = "About Page";
include_once('./layouts/head.php');

$aboutObj = new Page();
$aboutMe = $aboutObj->getAboutMe();
if (isset($_POST['submit'])) {
 $aboutObj->aboutMe($_POST);
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
          <h5 class="mb-0">About Me</h5>
         </div>
         <div class="card-body">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Title</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="title" id="category-name"
              value="<?php echo $aboutMe['title'] ?? ''; ?>" />
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
             <textarea class="form-control" name="description" id="reply" cols="30" rows="5"><?php echo $aboutMe['description'] ?? ''; ?></textarea>
             <span class="text-danger">
              <?php echo $result ?? ''; ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Address</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="address" id="category-name"
              value="<?php echo $aboutMe['address'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Facebook</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="facebook" id="category-name"
              value="<?php echo $aboutMe['facebook'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Linkedin</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="linkedin" id="category-name"
              value="<?php echo $aboutMe['linkedin'] ?? ''; ?>" />
             <span class="text-danger">
              <?php echo $result ?? "" ?>
             </span>
            </div>
           </div>
           <div class="row mb-3">
            <div class="col-sm-2">
             <label for="category-name" class="form-label">Github</label>
            </div>
            <div class="col-sm-10">
             <input type="text" class="form-control" name="github" id="category-name"
              value="<?php echo $aboutMe['github'] ?? ''; ?>" />
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