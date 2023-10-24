<?php
$realPath = dirname(__FILE__);
include_once $realPath . './../classes/Category.php';
$category = new Category();
$categories = $category->getAllCategories();
?>
<nav class="navbar navbar-expand-md  navbar-light bg-light">
    <div class="container">

        <a class="navbar-brand fs-4" href="index.php">Trendy Blog</a>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="category.html" id="dropdown05"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown05">
                        <?php foreach ($categories as $category): ?>
                            <a class="dropdown-item" href="category.php?id=<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </a>

                        <?php endforeach; ?>
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
            </ul>
            <div class="col-3 search-top pt-3">
                <form action="search-post.php" method="get" class="search-top-form">
                    <input type="text" name="search"  id="s" placeholder="Type keyword to search...">
                    <ion-icon class="icon fs-4" name="search-outline"></ion-icon>
                </form>
            </div>

        </div>
    </div>
</nav>