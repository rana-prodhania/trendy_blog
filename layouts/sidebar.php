<?php
$popular_posts = $postObj->getAllPopularPost($setting['pop_per_page']);
?>
<div class="col-lg-4">
 <div class="widget-area">

  <div class="sidebar-widget widget-latest-posts mb-50 wow fadeInUp animated">
   <div class="widget-header-1 position-relative mb-30">
    <h5 class="mt-5 mb-30">Most popular</h5>
   </div>
   <div class="post-block-list post-module-1">
    <ul class="list-post">
     <!-- Start Single Post -->
     <?php foreach ($popular_posts as $post): ?>
      <li class="mb-30 wow fadeInUp animated">
       <div class="d-flex bg-white has-border p-25 hover-up transition-normal border-radius-5">
        <div class="post-content media-body">
         <h6 class="post-title mb-15 text-limit-2-row font-medium"><a
           href="post-details.php?slug=<?php echo $post['slug']; ?>">
           <?php echo $post['title']; ?>
          </a></h6>
         <div class="entry-meta meta-1 float-start font-x-small text-uppercase">
          <span class="post-on">
           <?php echo date('d F', strtotime($post['created_at'])); ?>
          </span>
          <span class="post-by has-dot"><?php echo $post['views']; ?> views</span>
         </div>
        </div>
        <div class="post-thumb post-thumb-80 d-flex ml-15 border-radius-5 img-hover-scale overflow-hidden">
         <a class="color-white" href="post-details.php?slug=<?php echo $post['slug']; ?>">
          <img src="./admin/uploads/post-img/<?php echo $post['image']; ?>" alt="">
         </a>
        </div>
       </div>
      </li>
     <?php endforeach; ?>
     <!-- End Single Post -->
    </ul>
   </div>
  </div>
 </div>

</div>
</div>