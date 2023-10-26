<?php
$realPath = dirname(__FILE__);
include_once './layouts/head.php';
include_once $realPath . './classes/Post.php';
$postObj = new Post();
$postObj2 = new Post();
if (isset($_GET['slug'])) {
   $slug = $_GET['slug'];
   $post = $postObj->getPost($slug);
}
?>

<body class="theme-mode">
   <!-- Start Header -->
   <?php include_once './layouts/header.php'; ?>
   <!-- End Header -->
   <!-- Start Main Contain -->
   <main class="bg-grey pb-30">
      <div class="container single-content">
         <div class="entry-header entry-header-style-1 mb-50 pt-50">
            <h1 class="entry-title mb-50 font-weight-900">
               <?php echo $post['title']; ?>
            </h1>
            <div class="row">
               <div class="col-md-6">
                  <div class="entry-meta align-items-center meta-2 font-small color-muted">
                     <p class="mb-5">
                        <a class="author-avatar" href="#"><img class="img-circle" src="assets/imgs/authors/author-2.jpg"
                              alt=""></a>
                        By <a href="author.html"><span class="author-name font-weight-bold">
                              <?php echo $post['author']; ?>
                           </span></a>
                     </p>
                     <span class="mr-10">
                        <?php echo date('d F Y', strtotime($post['created_at'])); ?>
                     </span>
                     <span class="has-dot"> 8 mins read</span>
                  </div>
               </div>
               <div class="col-md-6 text-end d-none d-md-inline">
                  <ul class="header-social-network d-inline-block list-inline mr-15">
                     <li class="list-inline-item text-muted"><span>Share this: </span></li>
                     <li class="list-inline-item"><a class="social-icon fb text-xs-center" target="_blank" href="#"><i
                              class="elegant-icon social_facebook"></i></a></li>
                     <li class="list-inline-item"><a class="social-icon tw text-xs-center" target="_blank" href="#"><i
                              class="elegant-icon social_twitter "></i></a></li>
                     <li class="list-inline-item"><a class="social-icon pt text-xs-center" target="_blank" href="#"><i
                              class="elegant-icon social_pinterest "></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <!--end single header-->
         <figure class="image mb-30 m-auto text-center border-radius-10">
            <img class="border-radius-10" width="72%" src="admin/uploads/post-img/<?php echo $post['image']; ?>"
               alt="post-title" />
         </figure>
         <!--figure-->
         <article class="entry-wraper mb-50">
            <div class="entry-main-content dropcap wow fadeIn animated">
               <?php echo $post['description']; ?>
            </div>
            


            <!--comment form-->
            <div class="comment-form wow fadeIn animated">
               <div class="widget-header-2 position-relative mb-30">
                  <h5 class="mt-5 mb-30">Leave a Reply</h5>
               </div>
               <form class="form-contact comment_form" action="#" id="commentForm">
                  <div class="row">
                     <div class="col-12">
                        <div class="form-group">
                           <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                              placeholder="Write Comment"></textarea>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                        </div>
                     </div>

                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn button button-contactForm">Post Comment</button>
                  </div>
               </form>
            </div>
         </article>
      </div>
      <!--container-->
   </main>
   <!-- End Main content -->

   <!-- Footer Start-->
   <?php include './layouts/footer.php'; ?>
   <!-- End Footer -->
   <!-- Scripts -->
   <?php include './layouts/scripts.php'; ?>
</body>

</html>