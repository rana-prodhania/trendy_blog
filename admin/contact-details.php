<?php
$title = "Contact Details";
include_once './layouts/head.php';

$contactObj = new Page();

if ($_GET['id']) {
  $id = $_GET['id'];
  $contact = $contactObj->getContactMessage($id);
};
?>
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
                    <h5 class="mb-0">Contact Message Details</h5>
                    <a href="contact-msg.php" class="btn btn-sm btn-outline-danger">Back</a>
                  </div>
                  <div class="card-body">
                    <p>Name:
                      <?php echo $contact['name']; ?>
                    </p>
                    <p>Email:
                      <?php echo $contact['email']; ?>
                    </p>
                    <p>
                      Message:
                      <?php echo $contact['message']; ?>
                    </p>
                    
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
</body>

</html>