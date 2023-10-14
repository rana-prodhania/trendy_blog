<?php
// Determine the current page (you may need to customize this)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="dashboard.php" class="app-brand-link">
            <span class="app-brand-text text-capitalize demo menu-text fw-bolder ms-2">Trendy Blog</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?php if ($current_page === 'dashboard.php')
            echo 'active'; ?>" id="menu-dashboard">
            <a href="./dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">All Filed</span></li>
        <!-- Categories -->
        <li class="menu-item <?php if ($current_page === 'category.php')
            echo 'active'; ?>">
            <a href="category.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Categories</div>
            </a>
        </li>
        <!-- Post -->
        <li class="menu-item <?php if ($current_page === 'index-post.php')
            echo 'active'; ?>">
            <a href="./index-post.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div>Posts</div>
            </a>
        </li>
    </ul>
</aside>