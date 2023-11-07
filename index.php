<?php
include_once './layouts/head.php';
$tagObj = new Tag();
$postObj = new Post();
$all_tags = $tagObj->getAllTags(4);
$all_posts = $postObj->getAllPost($pagination);
$featured_posts = $postObj->getAllFeaturedPost(2);
?>

<body class="theme-mode">
    <!-- Start Header -->
    <?php include_once './layouts/header.php'; ?>
    <!-- Start Main content -->
    <main>
        <div class="container">
            <div class="hot-tags pt-30 pb-30 font-small align-self-center">
                <div class="widget-header-3">
                    <div class="row align-self-center">
                        <div class="col-md-4 align-self-center">
                            <h5 class="widget-title">Featured posts</h5>
                        </div>
                        <div class="col-md-8 text-md-end font-small align-self-center">
                            <p class="d-inline-block mr-5 mb-0"><i
                                    class="elegant-icon  icon_tag_alt mr-5 text-muted"></i>Hot tags:</p>
                            <ul class="list-inline d-inline-block tags">
                                <!-- tag -->
                                <?php foreach ($all_tags as $tag): ?>
                                    <li class="list-inline-item"><a href="tag-post.php?name=<?php echo $tag['name']; ?>">#
                                            <?php echo $tag['name']; ?>
                                        </a></li>
                                <?php endforeach; ?>
                                <!-- end tag -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Post -->
            <div class="loop-grid mb-30">
                <div class="row">
                    <div class="col-lg-8 mb-30">
                        <!-- 1st Featured post  -->
                        <div
                            class="carausel-post-1 hover-up border-radius-10 overflow-hidden transition-normal position-relative wow fadeInUp animated">
                            <div class="arrow-cover"></div>
                            <div class="slide-fade">
                                <div class="position-relative post-thumb">
                                    <div class="thumb-overlay img-hover-slide position-relative"
                                        style="background-image: url(admin/uploads/post-img/<?php echo $featured_posts[0]['image']; ?>)">
                                        <a class="img-link"
                                            href="post-details.php?slug=<?php echo $featured_posts[0]['slug']; ?>"></a>
                                        <div class="post-content-overlay text-white ml-30 mr-30 pb-30">
                                            <div class="entry-meta meta-0 font-small mb-20">
                                                <a href="#"><span class="post-cat text-info text-uppercase">
                                                        <?php echo $featured_posts[0]['category_name']; ?>
                                                    </span></a>
                                            </div>
                                            <h3 class="post-title font-weight-900 mb-20">
                                                <a class="text-white" href="#">
                                                    <?php echo $featured_posts[0]['title']; ?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta meta-1 font-small text-white mt-10 pr-5 pl-5">
                                                <span class="post-on">20 minutes ago</span>
                                                <span class="hit-count has-dot">150 Views</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End 1st Featured post -->
                    <!--2nd Featured post -->
                    <article class="col-lg-4 col-md-6 mb-30 wow fadeInUp animated" data-wow-delay="0.2s">
                        <div class="post-card-1 border-radius-10 hover-up">
                            <div class="post-thumb thumb-overlay img-hover-slide position-relative"
                                style="background-image: url(admin/uploads/post-img/<?php echo $featured_posts[1]['image']; ?>)">
                                <a class="img-link"
                                    href="post-details.php?slug=<?php echo $featured_posts[1]['slug']; ?>"></a>

                            </div>
                            <div class="post-content p-30">
                                <div class="entry-meta meta-0 font-small mb-10">
                                    <a href="category-post.php?slug=<?php echo $featured_posts[1]['category_slug']; ?>"><span
                                            class="post-cat text-info">
                                            <?php echo $featured_posts[1]['category_name']; ?>
                                        </span></a>

                                </div>
                                <div class="d-flex post-card-content">
                                    <h5 class="post-title mb-20 font-weight-900">
                                        <a href="post-details.php?slug=<?php echo $featured_posts[0]['slug']; ?>">
                                            <?php echo $featured_posts[1]['title']; ?>
                                        </a>
                                    </h5>
                                    <div class="entry-meta meta-1 float-start font-x-small text-uppercase">
                                        <span class="post-on">
                                            <?php echo date('d F', strtotime($featured_posts[1]['created_at'])); ?>
                                        </span>
                                        <span class="time-reading has-dot">2 mins read</span>
                                        <span class="post-by has-dot">100 views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- End 2nd Featured post -->
                </div>
            </div>
            <!-- End Featured Post -->
        </div>
        <div class="bg-grey pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Recent Post -->
                        <div class="post-module-3">
                            <div class="widget-header-1 position-relative mb-30">
                                <h5 class="mt-5 mb-30">Latest posts</h5>
                            </div>
                            <div class="loop-list loop-list-style-1">
                                <!-- Start Single Post -->
                                <?php
                                if (!empty($all_posts['data'])):
                                    $color = ['primary', 'secondary', 'success', 'warning', 'info'];
                                    foreach ($all_posts['data'] as $post):
                                        ?>
                                        <article class="hover-up-2 transition-normal wow fadeInUp animated">
                                            <div class="row mb-40 list-style-2">
                                                <div class="col-md-4">
                                                    <div class="post-thumb position-relative border-radius-5">
                                                        <div class="img-hover-slide border-radius-5 position-relative"
                                                            style="background-image: url(./admin/uploads/post-img/<?php echo $post['image']; ?>)">
                                                            <a class="img-link"
                                                                href="post-details.php?slug=<?php echo $post['slug']; ?>"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 align-self-center">
                                                    <div class="post-content">
                                                        <div class="entry-meta meta-0 font-small mb-10">
                                                            <a
                                                                href="category-post.php?slug=<?php echo $post['category_slug']; ?>"><span
                                                                    class="post-cat text-<?php echo $color[array_rand($color)]; ?>">
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
                                                            <span class="post-by has-dot"><?php echo random_int(0, 100) ?> views</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        <!-- End Single Post -->
                                        <?php
                                    endforeach;
                                else:
                                    echo "No post found";
                                endif;
                                ?>

                            </div>
                        </div>
                        <!-- End Recent Post -->
                        <!-- Start Pagination -->
                        <?php if (!empty($all_posts['data'])): ?>
                            <div class="pagination-area mb-30 wow fadeInUp animated">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                        <!-- Previous page-->
                                        <?php if ($all_posts['page'] == 1): ?>
                                            <li class="page-item <?php echo $all_posts['page'] == 1 ? 'disabled' : ''; ?>"><a
                                                    class="page-link" href="#"><i class="elegant-icon arrow_left"></i></a></li>
                                        <?php else: ?>
                                            <li class="page-item"><a class="page-link"
                                                    href="?page=<?php echo $all_posts['page'] - 1; ?>"><i
                                                        class="elegant-icon arrow_left"></i></a>
                                            </li>
                                        <?php endif; ?>
                                        <!-- Current page-->
                                        <?php for ($i = 1; $i <= $all_posts['totalPage']; $i++): ?>
                                            <li class="page-item <?php echo $all_posts['page'] == $i ? 'active' : ''; ?>"><a
                                                    class="page-link" href="?page=<?php echo $i; ?>">
                                                    <?php echo $i; ?>
                                                </a></li>
                                        <?php endfor ?>
                                        <!-- Next page-->
                                        <?php if ($all_posts['page'] == $all_posts['totalPage']): ?>
                                            <li
                                                class="page-item <?php echo $all_posts['page'] == $all_posts['totalPage'] ? 'disabled' : ''; ?>">
                                                <a class="page-link" href="#"><i class="elegant-icon arrow_right"></i></a>
                                            </li>
                                        <?php else: ?>
                                            <li class="page-item "><a class="page-link"
                                                    href="?page=<?php echo $all_posts['page'] + 1; ?>"><i
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