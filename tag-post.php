<?php
include_once './layouts/head.php';
$postObj = new Post();
if (isset($_GET['name'])) {
 $name = $_GET['name'];
 $categoryPosts = $postObj->getPostByTag($name, $pagination);
}
?>

<body class="theme-mode">
 <!-- Start Header -->
 <?php include_once './layouts/header.php'; ?>
 <!-- End Header -->
 <!-- Start Main Contain -->
 <main>
  <!--archive header-->
  <div class="archive-header pt-50">
   <div class="container">
    <h2 class="font-weight-900">#<?php echo $categoryPosts['data'][0]['name']?? $name; ?></h2>
    <div class="breadcrumb">
     <a href="index.html" rel="nofollow">Tag</a>
     <span></span>#<?php echo $categoryPosts['data'][0]['name']?? $name; ?>
    </div>
    <div class="bt-1 border-color-1 mt-30 mb-50"></div>
   </div>
  </div>
  <div class="pb-50">
   <div class="container">
    <div class="row">
     <div class="col-lg-8">
      <div class="post-module-3">
       <div class="loop-list loop-list-style-1">
        <!-- Start Single Post -->
        <?php
        if (!empty($categoryPosts['data'])):
         foreach ($categoryPosts['data'] as $post):
          ?>
          <article class="hover-up-2 transition-normal wow fadeInUp animated">
           <div class="row mb-40 list-style-2">
            <div class="col-md-4">
             <div class="post-thumb position-relative border-radius-5">
              <div class="img-hover-slide border-radius-5 position-relative"
               style="background-image: url(admin/uploads/post-img/<?php echo $post['image']; ?>)">
               <a class="img-link" href="post-details.php?slug=<?php echo $post['slug']; ?>"></a>
              </div>

             </div>
            </div>
            <div class="col-md-8 align-self-center">
             <div class="post-content">
              <div class="entry-meta meta-0 font-small mb-10">
               <a href="category.html"><span class="post-cat text-primary">
                 <?php echo $post['category_name']; ?>
                </span></a>
              </div>
              <h5 class="post-title font-weight-900 mb-20">
               <a href="post-details.php?slug=<?php echo $post['slug']; ?>">
                <?php echo $post['title']; ?>
               </a>

              </h5>
              <div class="entry-meta meta-1 float-start font-x-small text-uppercase">
               <span class="post-on">
                <?php echo date('d F', strtotime($post['created_at'])); ?>
               </span>
               <span class="time-reading has-dot">1 mins read</span>
               <span class="post-by has-dot"><?php echo $post['views']; ?> views</span>
              </div>
             </div>
            </div>
           </div>
          </article>
          <?php
         endforeach;
        else:
         echo $categoryPosts['message'];
        endif;
        ?>
        <!-- End Single Post -->
       </div>
      </div>
      <!-- Start Pagination -->
      <?php if (!empty($categoryPosts['data'])): ?>
       <div class="pagination-area mb-30 wow fadeInUp animated">
        <nav aria-label="Page navigation example">
         <ul class="pagination justify-content-start">
          <!-- Previous page-->
          <?php if ($categoryPosts['page'] == 1): ?>
           <li class="page-item <?php echo $categoryPosts['page'] == 1 ? 'disabled' : ''; ?>"><a class="page-link"
             href="#"><i class="elegant-icon arrow_left"></i></a></li>
          <?php else: ?>
           <li class="page-item"><a class="page-link"
             href="?name=<?php echo $_GET['name']; ?>&page=<?php echo $categoryPosts['page'] - 1; ?>"><i
              class="elegant-icon arrow_left"></i></a>
           </li>
          <?php endif; ?>
          <!-- Current page-->
          <?php for ($i = 1; $i <= $categoryPosts['totalPage']; $i++): ?>
           <li class="page-item <?php echo $categoryPosts['page'] == $i ? 'active' : ''; ?>"><a class="page-link"
             href="?name=<?php echo $_GET['name']; ?>&page=<?php echo $i; ?>">
             <?php echo $i; ?>
            </a></li>
          <?php endfor ?>
          <!-- Next page-->
          <?php if ($categoryPosts['page'] == $categoryPosts['totalPage']): ?>
           <li class="page-item <?php echo $categoryPosts['page'] == $categoryPosts['totalPage'] ? 'disabled' : ''; ?>">
            <a class="page-link" href="#"><i class="elegant-icon arrow_right"></i></a>
           </li>
          <?php else: ?>
           <li class="page-item "><a class="page-link"
             href="?name=<?php echo $_GET['name']; ?>&page=<?php echo $categoryPosts['page'] + 1; ?>"><i
              class="elegant-icon arrow_right"></i></a>
           </li>
          <?php endif; ?>

         </ul>
        </nav>
       </div>
      <?php endif; ?>
      <!-- End Pagination -->
     </div>
     <!-- Start Sidebar -->
     <?php include './layouts/sidebar.php'; ?>
     <!-- End Sidebar -->
    </div>
   </div>
  </div>
 </main>
 <!-- End Main content -->

 <!-- Footer Start-->
 <?php include './layouts/footer.php'; ?>
 <!-- End Footer -->
 <!-- Scripts -->
 <?php include './layouts/scripts.php'; ?>
</body>

</html>