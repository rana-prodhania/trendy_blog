<?php
// Determine the current page
$currentPage = basename($_SERVER['PHP_SELF']);
$siteSetting = new SiteSetting();
$setting = $siteSetting->getSiteSetting();
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="dashboard.php" class="app-brand-link">
            <span class="app-brand-text text-capitalize demo menu-text fw-bolder ms-2"><?php echo $setting['logo_text']??'Trendy Blog'; ?></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menus</span></li>
        <!-- Dashboard -->
        <li class="menu-item <?php if ($currentPage === 'dashboard.php')
            echo 'active'; ?>" id="menu-dashboard">
            <a href="./dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>
        <!-- Categories -->
        <li class="menu-item <?php if ($currentPage === 'categories.php' || $currentPage === 'add-category.php' || $currentPage === 'edit-category.php')
            echo 'active'; ?>">
            <a href="categories.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Categories</div>
            </a>
        </li>
        <!-- Tags -->
        <li class="menu-item <?php if ($currentPage === 'tags.php' || $currentPage === 'add-tag.php' || $currentPage === 'edit-tag.php')
            echo 'active'; ?>">
            <a href="tags.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                <div>Tags</div>
            </a>
        </li>
        <!-- Posts -->
        <li class="menu-item <?php if ($currentPage === 'posts.php' || $currentPage === 'add-post.php' || $currentPage === 'edit-post.php' || $currentPage === 'comments.php')
            echo 'active open'; ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons fs-4 bx bx-edit-alt"></i>
                <div class="text-truncate" data-i18n="Users">Posts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php if ($currentPage === 'posts.php' || $currentPage === 'add-post.php' || $currentPage === 'edit-post.php')
                    echo 'active'; ?>">
                    <a href="./posts.php" class="menu-link">
                        <div class="text-truncate" data-i18n="List">All Posts</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($currentPage === 'comments.php')
                    echo 'active'; ?>">
                    <a href="./comments.php" class="menu-link">
                        <div class="text-truncate" data-i18n="List">Comments</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pages</span></li>
        <!-- About Me-->
        <li class="menu-item <?php if ($currentPage === 'about.php')
            echo 'active'; ?>">
            <a href="about.php" class="menu-link">
                <i class="menu-icon fs-4 tf-icons bx bx-user-pin"></i>
                <div>About Page</div>
            </a>
        </li>
        <!-- Contact Me -->
        <li class="menu-item <?php if ($currentPage === 'contact-msg.php' || $currentPage === "contact-details.php")
            echo 'active'; ?>">
            <a href="contact-msg.php" class="menu-link">
                <i class="menu-icon fs-4 tf-icons bx bx-phone"></i>
                <div>Contact Page</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
        <!-- Site Settings -->
        <li class="menu-item <?php if ($currentPage === 'site_settings.php')
            echo 'active'; ?>">
            <a href="site_settings.php" class="menu-link">
                <i class="menu-icon fs-4 tf-icons bx bx-cog"></i>
                <div>Site Settings</div>
            </a>
        </li>

    </ul>
</aside>