<?php
session_start();
include_once './layouts/head.php';
$postObj = new Post();
$tagObj = new Tag();
$commentObj = new Comment();

$slug = $_GET['slug'] ?? '';
$post = $postObj->getPost($slug);
$addView = $postObj->increaseViewCount($slug);
$relatedPosts = $postObj->getRelatedPosts($post['category_id'], $post['slug'], $setting['rel_posts_limit']);

$postID = $post['id'] ?? '';
$postTags = $tagObj->getAllTagsFromPost($postID);

$comments = $commentObj->getAllComments($postID);
if (isset($_POST['submit']) && !empty($slug)) {
   $result = $commentObj->addComment($slug, $_POST);
}
echo var_dump($_SESSION);
?>

<body class="theme-mode">
   <!-- Start Header -->
   <?php include_once './layouts/header.php'; ?>
   <!-- End Header -->
   <!-- Start Main Contain -->
   <main class="bg-grey pb-30">
      <div class="container single-content">
         <div class="entry-header entry-header-style-1 mb-50 pt-50">
            <!-- Success Alert -->
            <?php
            if ($commentObj->success) {
               ?>
               <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?php echo $commentObj->success['message']; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
            <?php } ?>
            <!-- End Success Alert -->
            <h1 class="entry-title mb-50 font-weight-900">
               <?php echo $post['title'] ?? '' ?>
            </h1>
            <div class="row">
               <div class="col-md-6">
                  <div class="entry-meta align-items-center meta-2 font-small color-muted">
                     <p class="mb-5">
                        <a class="author-avatar" href="#"><img class="img-circle"
                              src="admin/uploads/profile/<?php echo $post['admin_profile'] ?? ''; ?>" alt=""></a>
                        By <a href="author.html"><span class="author-name font-weight-bold">
                              <?php echo $post['author']; ?>
                           </span></a>
                     </p>
                     <span class="mr-10">
                        <?php echo date('d F Y', strtotime($post['created_at']) ?? ''); ?>
                     </span>
                     <span class="has-dot">
                        <?php echo Helper::readingTime($post['title'], $post['description']); ?> mins read
                     </span>
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
            <div class="entry-main-content wow fadeIn animated">
               <?php echo $post['description'] ?? '' ?>
            </div>
            <!-- Tags -->
            <div class="entry-bottom mt-50 mb-30 wow fadeIn  animated"
               style="visibility: visible; animation-name: fadeIn;">
               <div class="tags">
                  <span>Tags: </span>
                  <?php foreach ($postTags as $tag): ?>
                     <a href="tag-post.php?name=<?php echo $tag['name']; ?>" rel="tag">#
                        <?php echo $tag['name']; ?>
                     </a>
                  <?php endforeach; ?>
               </div>
            </div>
            <!--related posts-->
            <?php if (!empty($relatedPosts)): ?>
            <div class="related-posts">
               <div class="post-module-3">
                  <div class="widget-header-2 position-relative mb-30">
                     <h5 class="mt-5 mb-30">Related posts</h5>
                  </div>
                  <div class="loop-list loop-list-style-1">
                     <!--single related post -->
                     <?php foreach ($relatedPosts as $relatedPost): ?>
                     <article class="hover-up-2 transition-normal wow fadeInUp  animated">
                        <div class="row mb-40 list-style-2">
                           <div class="col-md-4">
                              <div class="post-thumb position-relative border-radius-5">
                                 <div class="img-hover-slide border-radius-5 position-relative"
                                    style="background-image: url(admin/uploads/post-img/<?php echo $relatedPost['image']; ?>)">
                                    <a class="img-link" href="post-details.php?slug=<?php echo $relatedPost['slug']; ?>"></a>
                                 </div>
                                 
                              </div>
                           </div>
                           <div class="col-md-8 align-self-center">
                              <div class="post-content">
                                 <div class="entry-meta meta-0 font-small mb-10">
                                    <a href="category.html"><span class="post-cat text-primary"><?php echo $relatedPost['category_name']; ?></span></a>
                                 </div>
                                 <h5 class="post-title font-weight-900 mb-20">
                                    <a href="post-details.php?slug=<?php echo $relatedPost['slug']; ?>"><?php echo $relatedPost['title']; ?></a>
                                    
                                 </h5>
                                 <div class="entry-meta meta-1 float-start font-x-small text-uppercase">
                                    <span class="post-on"><?php echo date('d F', strtotime($relatedPost['created_at'])); ?></span>
                                    <span class="time-reading has-dot">1 mins read</span>
                                    <span class="post-by has-dot"><?php echo random_int(0, 100) ?> views</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </article>
                     <?php endforeach; ?>
                     <!-- single related post -->
                     <!-- <article class="hover-up-2 transition-normal wow fadeInUp  animated">
                        <div class="row mb-40 list-style-2">
                           <div class="col-md-4">
                              <div class="post-thumb position-relative border-radius-5">
                                 <div class="img-hover-slide border-radius-5 position-relative"
                                    style="background-image: url(assets/imgs/news/news-4.jpg)">
                                    <a class="img-link" href="single.html"></a>
                                 </div>
                                 <ul class="social-share">
                                    <li><a href="#"><i class="elegant-icon social_share"></i></a></li>
                                    <li><a class="fb" href="#" title="Share on Facebook" target="_blank"><i
                                             class="elegant-icon social_facebook"></i></a></li>
                                    <li><a class="tw" href="#" target="_blank" title="Tweet now"><i
                                             class="elegant-icon social_twitter"></i></a></li>
                                    <li><a class="pt" href="#" target="_blank" title="Pin it"><i
                                             class="elegant-icon social_pinterest"></i></a></li>
                                 </ul>
                              </div>
                           </div>
                           <div class="col-md-8 align-self-center">
                              <div class="post-content">
                                 <div class="entry-meta meta-0 font-small mb-10">
                                    <a href="category.html"><span class="post-cat text-success">Cooking</span></a>
                                 </div>
                                 <h5 class="post-title font-weight-900 mb-20">
                                    <a href="single.html">10 Easy Ways to Be Environmentally Conscious At Home</a>
                                 </h5>
                                 <div class="entry-meta meta-1 float-start font-x-small text-uppercase">
                                    <span class="post-on">27 Sep</span>
                                    <span class="time-reading has-dot">10 mins read</span>
                                    <span class="post-by has-dot">22k views</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </article> -->
                  </div>
               </div>
            </div>
            <?php endif; ?>
            <!-- end related posts -->
            <!--comments area-->
            <?php if (!empty($comments)): ?>
            <div class="comments-area">
               <div class="widget-header-2 position-relative mb-30">
                  <h5 class="mt-5 mb-30">Comments</h5>
               </div>
               <?php foreach ($comments as $comment): ?>
                  <div class="comment-list wow fadeIn  animated" style="visibility: visible; animation-name: fadeIn;">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">
                              <img src="assets/imgs/authors/profile.png" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                 <?php echo $comment['message']; ?>
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#">
                                          <?php echo ucfirst($comment['name']); ?>
                                       </a>
                                    </h5>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php if (!empty($comment['reply'])): ?>
                        <div class="single-comment depth-2 justify-content-between d-flex mt-50">
                           <div class="user justify-content-between d-flex">
                              <div class="thumb">
                                 <img src="admin/uploads/profile/<?php echo $post['admin_profile'] ?? '' ?>" alt="">
                              </div>
                              <div class="desc">
                                 <p class="comment">
                                    <?php echo $comment['reply']; ?>
                                 </p>
                                 <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                       <h5>
                                          <a href="#">
                                             <?php echo ucfirst($post['author']); ?>
                                          </a>
                                       </h5>

                                    </div>

                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endif; ?>
                  </div>
               <?php endforeach; ?>

            </div>
            <!--end comments area-->
            <?php endif; ?>
            
            <!--comment form-->
            <div class="mt-50 wow fadeIn animated">
               <div class="widget-header-2 position-relative mb-30">
                  <h5 class="mt-5 mb-30">Leave a Reply</h5>
                  <span class="text-muted">Please fill in all fields to submit your comment.</span>
               </div>

               <form class="form-contact comment_form" action="post-details.php?slug=<?php echo $slug; ?>"
                  id="commentForm" method="POST">
                  <input class="form-control" name="post_id" id="name" type="hidden" value="<?php echo $post['id']; ?>"
                     placeholder="Name">
                  <div class="row">
                     <div class="col-12">
                        <div class="form-group">

                           <textarea class="form-control w-100" name="message" id="comment" cols="30" rows="9"
                              placeholder="Write Comment"></textarea>
                           <span class="text-danger ms-2">
                              <?php echo $commentObj->error['message'] ?? '' ?>
                           </span>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                           <span class="text-danger ms-2">
                              <?php echo $commentObj->error['name'] ?? '' ?>
                           </span>

                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                           <span class="text-danger ms-3">
                              <?php echo $commentObj->error['email'] ?? '' ?>
                           </span>
                        </div>
                     </div>

                  </div>
                  <div class="form-group">
                     <button type="submit" name="submit" class="btn button button-contactForm">Post Comment</button>
                  </div>
               </form>
            </div>
            <!-- End comment form -->
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
   <script>
      function closeAlert() {
         const alert = document.querySelector('.alert');
         if (alert) {
            alert.remove();
         }
      }
      document.querySelector('.alert .btn-close').addEventListener('click', closeAlert);
      setTimeout(closeAlert, 2000);
   </script>

</body>

</html>