<?php
$title = "Comments";
include_once './layouts/head.php';
include_once './layouts/custom-css.php';

$commentObj = new Comment();
$comments = $commentObj->getAllCommentsAdmin();
if (isset($_GET['id'])) {
 $id = $_GET['id'];
 $commentObj->deleteComment($id);
}
if (isset($_GET['active'])) {
 $commentObj->activateComment($_GET['active']);
}
if (isset($_GET['deactive'])) {
 $commentObj->deactivateComment($_GET['deactive']);
}
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

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4 justify-content-center">
              <div class="col-xxl">
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
                <div class="card mb-4 p-3">
                  <div class="card-header px-0 m-0 d-flex justify-content-between">
                    <div class="head-label">
                      <h5 class="card-title mb-0">
                        List of Comments
                      </h5>
                    </div>
                  </div>
                  <table id="example" class="table table-striped" style="width: 100%">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Message</th>
                        <th>Reply</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($comments) {
                        $i = 1;
                        while ($row = $comments->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>
                            <td>
                              <?php echo $i++; ?>
                            </td>
                            <td>
                              <?php echo $row['name']; ?>
                            </td>
                            <td>
                              <?php echo Helper::textShorten($row['message'], 20); ?>
                            </td>
                            <td>
                              <?php echo ($row['reply'])?Helper::textShorten($row['reply'], 20):'no reply'; ?>
                            </td>
                            <td class="text-center">

                              <a
                                class="btn btn-sm btn-outline-info" href="comment-details.php?id=<?php echo $row['id']; ?>"><i class=" fs-5 bx bx-glasses"></i></a>
                              <?php if ($row['status'] == 0) : ?>
                                <a class="btn btn-sm btn-outline-warning " href="?active=<?php echo $row['id']; ?>"><i class="fs-5 bx bx-down-arrow-alt"></i></a>
                              <?php else : ?>
                                <a class="btn btn-sm btn-outline-success " href="?deactive=<?php echo $row['id']; ?>"><i class="fs-5 bx bx-up-arrow-alt"></i></a>
                              <?php endif; ?>
                              <a class="btn btn-sm btn-outline-primary"
                                href="comment-reply.php?id=<?php echo $row['id']; ?>">
                                <i class="fs-5 bx bx-edit"></i>
                              </a>

                              <a class="btn btn-sm btn-outline-danger btn-delete" href="?id=<?php echo $row['id']; ?>"><i
                                  class="fs-5 bx bx-trash"></i></a>

                            </td>
                          </tr>
                          <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
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