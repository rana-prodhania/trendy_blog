<?php
$realPath = dirname(__FILE__);
include_once './inc/head.php';
include_once $realPath . './classes/Post.php';
$post = new Post();
if (isset($_GET['slug'])) {
  $slug = $_GET['slug'];
  $posts = $post->getPost($slug);
}
?>

<body>
  <div class="wrap">
    <!-- START header -->
    <?php include_once './inc/header.php'; ?>
    <!-- END header -->

    <section class="site-section py-lg">
      <div class="container">
        <div class="row blog-entries element-animate mt-3">
          <div class="col-md-12 col-lg-8 main-content ">

            <a class="category mb-4" href="#">
              <?php echo $posts['category_name']; ?>
            </a>

            <div >
              <h2 class="mb-4">
                <?php echo $posts['title']; ?>
              </h2>
              <div class="post-meta">
                <span class="author mr-2"><img src="images/person_1.jpg" alt="" class="mr-2">
                  <?php echo $posts['author']; ?>
                </span>&bullet;
                <span class="mr-2">
                  <?php echo date('F j, Y', strtotime($posts['created_at'])); ?>
                </span> &bullet;
                <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
              </div>
              <img src="./admin/uploads/post-img/<?php echo $posts['image']; ?>" alt="Image" class="img-fluid mb-5">
            </div>

            <div class="post-content-body">
              <div>
                <?php echo $posts['description']; ?>
              </div>

              <div class="pt-5">
                Tags: <a href="#">#manila</a>, <a href="#">#asia</a></p>
              </div>
            </div>

            <!-- START comment -->

            <!-- END comments -->
          </div>

          <!-- END main-content -->

          <!-- START sidebar -->
          <?php include_once './inc/sidebar.php'; ?>
          <!-- END sidebar -->
        </div>
      </div>
    </section>

    <!--START related post  -->

    <!-- END related post -->

    <!-- START footer -->
    <?php include 'inc/footer.php'; ?>
    <!-- END footer -->
    <?php include 'inc/script.php'; ?>
</body>

</html>