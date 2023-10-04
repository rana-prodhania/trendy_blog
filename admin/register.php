<?php
session_start();
include_once('./inc/head.php');
include '../classes/Register.php';

$register = new Register();

if (isset($_POST['submit'])) {
  $result = $register->addUser($_POST);
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
      <!-- Register Card -->
      <div class="card">
        <div class=" card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center my-4">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-text demo text-body fw-bold text-capitalize">Trendy Blog</span>
            </a>
          </div>

          <form id="formAuthentication" class="mb-3" action="" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                autofocus="" />
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                autofocus="" />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
            </div>
            <div class="mb-3 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" placeholder="············"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                <label class="form-check-label" for="terms-conditions">
                  I agree to
                  <a href="javascript:void(0);">privacy policy &amp; terms</a>
                </label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary d-grid w-100">Sign up</button>
          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="./login.php">
              <span>Sign in instead</span>
            </a>
          </p>
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>
<!-- / Content -->

<?php include_once './inc/script.php'; ?>