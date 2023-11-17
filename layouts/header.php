<?php
$category = new Category();
$categories = $category->getAllCategories();

?>

<!-- Start Preloader -->
<div class="preloader text-center">
 <div class="circle"></div>
</div>
<!-- Start Header -->
<header class="main-header header-style-1 font-heading">
   <div class="header-top">
      <div class="container">
         <div class="row pt-20 pb-20">
            <div class="col-md-3 col-6">
               <a href="index.php"><h6 class="fs-3 text-decoration-underline text-dark"><?php echo $setting['logo_text']??'Trendy Blog'; ?></h6></a>
            </div>
            <div class="col-md-9 col-6 text-end header-top-right ">

               <ul class="list-inline nav-topbar d-none d-md-inline">
                  <li class="list-inline-item"><a href="index.php"><i class="elegant-icon icon_home mr-5"></i>Home</a>
                  </li>
                  <li class="list-inline-item menu-item-has-children"><a href="#">Category</a>
                     <ul class="sub-menu font-small">
                        <?php foreach ($categories as $category): ?>
                           <li class=""><a href="category-post.php?slug=<?php echo $category['slug']; ?>"><?php echo $category['name']; ?></a></li>
                        <?php endforeach; ?>
                     </ul>

                  </li>
                  <li class="list-inline-item"><a href="about.php"><i class="elegant-icon  mr-5"></i>About</a></li>
                  <li class="list-inline-item"><a href="contact.php"><i class="elegant-icon  mr-5"></i>Contact</a></li>
               </ul>
               <span class="vertical-divider mr-20 ml-20 d-none d-md-inline"></span>
               <button class="search-icon d-none d-md-inline"><span class="mr-15 text-muted font-small"><i
                        class="elegant-icon icon_search mr-5"></i>Search</span></button>
               <div class="dark-light-mode-cover">
                  <a class="dark-light-mode" href="#"></a>
               </div>

            </div>
         </div>
      </div>
   </div>
</header>
<!--Start search form-->
<div class="main-search-form">
   <div class="container">
      <div class=" pt-50 pb-50 ">
         <div class="row mb-20">
            <div class="col-12 align-self-center main-search-form-cover m-auto">
               <p class="text-center"><span class="search-text-bg">Search</span></p>
               <form action="search-post.php" method="get" class="search-header">
                  <div class="input-group w-100">
                     <input type="text" name="search" class="form-control" placeholder="Search post, tag and category">
                     <div class="input-group-append">
                        <button class="btn btn-search bg-white" type="submit">
                           <i class="elegant-icon icon_search"></i>
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>