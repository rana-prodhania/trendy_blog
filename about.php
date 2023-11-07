<?php
include_once './layouts/head.php';
$aboutObj = new Page();
$about = $aboutObj->getAboutMe();
?>

<body class="theme-mode">
 <!-- Start Header -->
 <?php include_once './layouts/header.php'; ?>
 <!-- End Header -->
 <!-- Start Main Contain -->
 <main class="pb-30">
  <div class="container single-content">
   <div class="entry-header entry-header-style-1 mb-50 pt-50 text-center">
    <h1 class="entry-title mb-20 font-weight-900 ">
     <?php echo $about['title']; ?>
    </h1>
   </div>
   <article class="entry-wraper">
    <p class="font-large"><?php echo $about['description']; ?></p>
    <hr class="wp-block-separator is-style-wide">
    <p><span class="mr-5">
      <ion-icon name="location-outline" role="img" class="md hydrated" aria-label="location outline"></ion-icon>
     </span><strong>Address</strong>: <?php echo $about['address']; ?></p>
    <p><span class="mr-5">
      <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>
     </span><strong>Facebook</strong>: <a href="<?php echo $about['facebook']; ?>"><?php echo $about['facebook']; ?></a></p>
    <p><span class="mr-5">
      <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>
     </span><strong>linkedin</strong>: <a href="<?php echo $about['linkedin']; ?>"><?php echo $about['linkedin']; ?></a></p>
    <p><span class="mr-5">
      <ion-icon name="home-outline" role="img" class="md hydrated" aria-label="home outline"></ion-icon>
     </span><strong>Github</strong>: <a href="<?php echo $about['github']; ?>"><?php echo $about['github']; ?></a></p>
    
   </article>
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