<?php
include_once('./inc/head.php');
include '../classes/Category.php';

$category = new Category();

if (isset($_POST['submit'])) {
 $result = $category->addCategory($_POST);
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

       <!-- Register -->
       <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
         <h5 class="mb-0">Add Post</h5>
        </div>
        <div class="card-body">
         <form action="" method="POST">

          <div class="row mb-3">
           <div class="col-sm-2">
            <label for="validationCustom03" class="form-label">Post Title</label>
           </div>
           <div class="col-sm-10">
            <input type="text" class="form-control" name="post-title" id="validationCustom03" />
            <?php
            if (isset($result)) {
             ?>
             <div class="text-danger">
              <?php echo $result; ?>
             </div>
            <?php } ?>
           </div>
          </div>
          <div class="row mb-3">
           <div class="col-sm-2">
            <label for="defaultSelect" class="form-label">Select Category</label>
           </div>
           <div class="col-sm-10">
            <select id="defaultSelect" name="category" class="form-select">
             <option>Default select</option>
             <option value="1">One</option>
             <option value="2">Two</option>
             <option value="3">Three</option>
            </select>
           </div>
          </div>
          <div class="row mb-3">
           <div class="col-sm-2">
            <label for="formFile" class="form-label">Select Image</label>
           </div>
           <div class="col-sm-10">
            <input class="form-control" name="post-image" type="file" id="formFile">
           </div>
          </div>
          <div class="card">
           <h5 class="card-header">Full Editor</h5>
           <div class="card-body">
            <div id="full-editor">
             <h6>Quill Rich Text Editor</h6>
             <p> Cupcake ipsum dolor sit amet. Halvah cheesecake chocolate bar gummi bears cupcake. Pie macaroon bear
              claw. Soufflé I love candy canes I love cotton candy I love. </p>
            </div>
           </div>
          </div>
          <div class="row justify-content-end">
           <div class="col-sm-10">
            <button type="submit" name="submit" class="btn btn-primary">
             Add Category
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