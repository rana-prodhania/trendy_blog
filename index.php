<?php
$realPath = dirname(__FILE__);
include_once './inc/head.php';
include_once $realPath . './classes/Post.php';
$post = new Post();
$posts = $post->getAllPost();
?>

<body>

  <div class="wrap">

    <!-- START navbar -->
    <?php include_once('inc/header.php'); ?>
    <!-- END navbar -->

    <!-- START main content -->
    <section class="site-section py-sm">
      <div class="container mt-5">
        <!-- <h4 class="mt-4 mb-3">Latest Posts</h4> -->
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row">
              <?php
              if ($posts) {
                $i = 1;
                while ($row = $posts->fetch(PDO::FETCH_ASSOC)) { ?>

                  <div class="col-md-6 h-100">
                    <a href="post-details.php?slug=<?php echo $row['slug']; ?>" class="blog-entry element-animate"
                      data-animate-effect="fadeIn">
                      <img src="./admin/uploads/post-img/<?php echo $row['image']; ?>" alt="Image placeholder">
                      <div class="blog-content-body">
                        <div class="post-meta">
                          <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib">
                            <?php echo $row['author']; ?>
                          </span>&bullet;
                          <span class="mr-2">
                            <?php echo date('F j, Y', strtotime($row['created_at'])); ?>
                          </span> &bullet;
                          <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                        </div>
                        <h2>
                          <?php echo Helper::textShorten($row['title'], 65); ?>
                        </h2>
                      </div>
                    </a>
                  </div>
                  <?php
                }
              }
              ?>
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
              <div class="col-md-12 text-center">
                <nav aria-label="Page navigation" class="text-center">
                  <ul class="pagination">
                    <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                  </ul>
                </nav>
              </div>
            </div>

          </div>

          <!-- END main-content -->

          <!-- START sidebar -->
          <?php include_once './inc/sidebar.php'; ?>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    <!-- START footer -->
    <?php include_once './inc/footer.php'; ?>
    <!-- END footer -->

  </div>

  <!-- JavaScript -->
  <?php include_once './inc/script.php'; ?>
</body>

</html>