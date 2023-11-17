<?php
$title = "Dashboard";
include_once './layouts/head.php';
$dashboard = new Dashboard();
$allPostCount = $dashboard->getAllPostCount();
$allDraftPostCount = $dashboard->getAllDraftPostCount();
$allPublishedPostCount = $dashboard->getAllPublishedPostCount();
$allCategoryCount = $dashboard->getAllCategoryCount(); 
?>
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
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-primary"><i class="bx bxs-envelope"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo $allPostCount; ?></h4>
                  </div>
                  <p class="mb-1">All available post</p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-error"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo $allDraftPostCount; ?></h4>
                  </div>
                  <p class="mb-1">Pending post</p>
                  
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-success"><i class="bx bx-envelope-open"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo $allPublishedPostCount; ?></h4>
                  </div>
                  <p class="mb-1">Active post </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
              <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                      <span class="avatar-initial rounded bg-label-info"><i class="bx bx-time-five"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0"><?php echo $allCategoryCount; ?></h4>
                  </div>
                  <p class="mb-1">All category</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->

      </div>
    </div>
    <!-- / Layout page -->
  </div>
</div>

<!-- JavaScript -->
<?php include_once './layouts/script.php'; ?>