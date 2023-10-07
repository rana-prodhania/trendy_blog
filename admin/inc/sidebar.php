<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text text-capitalize demo menu-text fw-bolder ms-2">Trendy Blog</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="./index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>
        <!-- Categories -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">All Filed</span></li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div>Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="./add-category.php" class="menu-link">
                        <div>Add Category</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="./list-category.php" class="menu-link">
                        <div>List of Category</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Post -->

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div>Post</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="./add-post.php" class="menu-link">
                        <div>Add Post</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="./list-post.php" class="menu-link">
                        <div>List of Post</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>