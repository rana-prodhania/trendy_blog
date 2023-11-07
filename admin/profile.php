<?php
$title = "Profile";
include_once './layouts/head.php';

$profileObj = new Profile();
$profile = $profileObj->getProfile();

if (isset($_POST['profile'])) {
  $result = $profileObj->updateProfile($_POST, $_FILES);
}
if (isset($_POST['password'])) {
  $result = $profileObj->updatePassword($_POST);
}
if (isset($_POST['delete-profile'])) {
  $result = $profileObj->deleteAccount();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css
" rel="stylesheet">
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
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-md-12">
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
              <!-- Profile -->
              <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <div class="card-body">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="formAccountSettings" method="post"
                    enctype="multipart/form-data">
                    <div class="row">
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label for="validationCustom03" class="form-label">Avatar</label>
                        </div>
                        <div class="col-md-10 w-25">

                          <input data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png webp"
                            data-height="200"
                            data-default-file="uploads/profile/<?php echo $profile['avatar'] != null ? $profile['avatar'] : 'default.png'; ?>"
                            class="form-control dropify" name="avatar" type="file" id="formFile">
                          <input type="hidden" name="old-image" value="<?php echo $profile['avatar']; ?>" />

                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label for="validationCustom03" class="form-label">Name</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" value="<?php echo $profile['name'] ?? "" ?>" class="form-control"
                            name="name" id="validationCustom03" placeholder="Admin" />
                          <span class="text-danger">
                            <?php echo $profileObj->error['name'] ?? '' ?>
                          </span>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-2">
                          <label for="validationCustom03" class="form-label">Email</label>
                        </div>
                        <div class="col-sm-10">
                          <input type="email" value="<?php echo $profile['email'] ?? "" ?>" class="form-control"
                            name="email" id="validationCustom03" placeholder="admin@email.com" />
                          <span class="text-danger">
                            <?php echo $profileObj->error['email'] ?? '' ?>
                          </span>
                        </div>
                      </div>
                      <div class="row justify-content-end">
                        <div class="col-sm-10">
                          <button type="submit" name="profile" class="btn btn-primary">
                            Save
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- / Profile -->
              <!-- Change Password -->
              <div class="card mb-4">
                <h5 class="card-header">Change Password</h5>
                <div class="card-body">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="formAccountSettings" method="POST">
                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label class="form-label" for="currentPassword">Current Password</label>
                      </div>
                      <div class="col-sm-10 ">
                        <input class="form-control" type="password" name="currentPassword" value="<?php echo $_POST['currentPassword'] ?? "" ?>" id="currentPassword"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="text-danger">
                          <?php echo $profileObj->error['currentPassword'] ?? '' ?>
                        </span>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-sm-2">
                        <label class="form-label" for="newPassword">New Password</label>
                      </div>
                      <div class="col-sm-10">
                        <input class="form-control" type="password" id="newPassword" value="<?php echo $_POST['newPassword'] ?? "" ?>" name="newPassword"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                        <span class="text-danger">
                          <?php echo $profileObj->error['newPassword'] ?? '' ?>
                        </span>
                      </div>
                    </div>
                    <div class="row justify-content-end">
                      <div class="col-sm-10">
                        <button type="submit" name="password" class="btn btn-primary">
                          Save
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!--/ Change Password -->
              <!-- Delete Account -->
              <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                  <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                      <h6 class="alert-heading fw-medium mb-1">Are you sure you want to delete your account?</h6>
                      <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                  </div>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="formAccountDeactivation">
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" checked name="accountActivation" id="accountActivation" />
                      <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                    </div>
                    <button type="submit" name="delete-profile" class="btn btn-danger deactivate-account .btn-delete">Delete Account</button>
                  </form>
                </div>
              </div>
              <!--/ Delete Account -->
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.dropify').dropify();
    })
  </script>
</body>

</html>