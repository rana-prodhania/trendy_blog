<?php
include_once('./inc/head.php');
include '../classes/Login.php';
$login = new Login();

if (isset($_POST['submit'])) {
  $result = $login->login($_POST);
}

if (isset($_SESSION['user_id'])) {
  header('Location: ./index.php');
  exit;
}
?>

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
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center my-4">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-text demo text-body fw-bold text-capitalize">Trendy Blog</span>
            </a>
          </div>

          <form id="formAuthentication" class="mb-3" action="" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email"
                autofocus="" />
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-basic.html">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="············"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
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
            <a href="./register.php">
              <span>Create an account</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>

<!-- / Content -->

<?php
include_once './inc/script.php';


?>