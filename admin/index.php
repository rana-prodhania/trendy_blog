<?php
$title = "Admin Login";
include_once '../classes/Login.php';
$login = new Login();

if (isset($_POST['submit'])) {
  $result = $login->login($_POST);
}

if(isset($_SESSION['id'])) {
  header('Location: dashboard.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <!-- Core CSS -->
  <link rel="stylesheet" href="./assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="./assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="./assets/css/demo.css" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="./assets/vendor/css/pages/page-auth.css">
</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
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
        <!-- Login -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center my-4">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-body fw-bold text-capitalize">Trendy Blog</span>
              </a>
            </div>

            <form id="formAuthentication" class="mb-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email"
                  autofocus="" />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <p>
                    <small class="form-text">Forgot Password?</small>
                  </p>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="············"
                    aria-describedby="password" />
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me">
                    Remember Me
                  </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="submit">
                  Sign in
                </button>
              </div>
            </form>
            <p class="text-center">
              <span>New on our platform?</span>
              <a class="d-inline-block">
                <span class="text-primary">Create an account</span>
              </a>
            </p>
          </div>
        </div>
        <!-- / Login -->
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

  <!-- / Content -->
</body>

</html>