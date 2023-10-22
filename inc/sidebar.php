<?php
$realPath = dirname(__FILE__);
include_once $realPath . "./../classes/Category.php";
include_once $realPath . "./../classes/Tag.php";
$category = new Category;
$tag = new Tag;
$categories = $category->getAllCategories();
$tags = $tag->getAllTags();
?>
<div class="col-md-12 col-lg-4 sidebar">
    
    <div class="sidebar-box ">
        <h3 class="heading">Popular Posts</h3>
        <div class="post-entry-sidebar">
            <ul>
                <li>
                    <a href="">
                        <img src="images/img_2.jpg" alt="Image placeholder" class="mr-4">
                        <div class="text">
                            <h6 class="ms-2 text-black fw-bolder">How to Find the Video Games of Your Youth</h6>
                            <div class="post-meta ms-2">
                                <span class="">March 15, 2018 </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="images/img_4.jpg" alt="Image placeholder" class="mr-4">
                        <div class="text">
                            <h6 class="ms-2 text-black fw-bolder">How to Find the Video Games of Your Youth</h6>
                            <div class="post-meta ms-2">
                                <span class="mr-2">March 15, 2018 </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="images/img_12.jpg" alt="Image placeholder" class="mr-4">
                        <div class="text">
                            <h6 class="ms-2 text-black fw-bolder">How to Find the Video Games of Your Youth</h6>
                            <div class="post-meta ms-2">
                                <span class="mr-2">March 15, 2018 </span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
        <h3 class="heading">Categories</h3>
        <ul class="categories">
        <?php foreach ($categories as $category): ?>
            <li><a href="#"><?php echo $category['name']; ?> <span>(12)</span></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- END sidebar-box -->

    <div class="sidebar-box">
        <h3 class="heading">Tags</h3>
        <ul class="tags">
            <?php foreach ($tags as $tag): ?>
            <li><a href="#"><?php echo $tag['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>