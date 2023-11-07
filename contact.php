<?php
include_once './layouts/head.php';
$contactObj = new Page();
if (isset($_POST['submit'])) {
    $contactObj->addContact($_POST);
}
?>

<body class="theme-mode">
    <!-- Start Header -->
    <?php include_once './layouts/header.php'; ?>
    <!-- End Header -->
    <main class=" pb-30">
        <div class="entry-header entry-header-style-2 pb-30 pt-30 mb-50 text-white"
            style="background-image: url(assets/imgs/banner.jpg)">
            <div class="container entry-header-content">
                <h1 class="entry-title mb-50 font-weight-900">
                    Get in Touch
                </h1>
            </div>
        </div>
        <div class="container single-content">
            <div class="entry-wraper mt-50">
                <!-- Success Alert -->
                <?php
                if ($contactObj->success) {
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $contactObj->success['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <!-- / Success Alert -->
                <h1 class="mt-30">Contact Me</h1>
                <hr class="wp-block-separator is-style-wide">
                <form class="form-contact comment_form" action="#" method="post" id="commentForm">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="comment" cols="30" rows="9"
                                    placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="button button-contactForm">Send message</button>
                    </div>
                </form>
            </div>
        </div>
        <!--container-->
    </main>
    <!-- End Main content -->

    <!-- Footer Start-->
    <?php include './layouts/footer.php'; ?>
    <!-- End Footer -->
    <!-- Scripts -->
    <?php include './layouts/scripts.php'; ?>
    <script>
        function closeAlert() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }
        document.querySelector('.alert .btn-close').addEventListener('click', closeAlert);
        setTimeout(closeAlert, 2000);
    </script>
</body>

</html>