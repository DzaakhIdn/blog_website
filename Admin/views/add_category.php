<?php
require_once __DIR__ . '/../Classes/Category.php';

$category = new Category();


if (isset($_POST["submit"])) {
    $result = $category->create_category($_POST, $_FILES);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./../assets/images/favicon.svg" type="image/x-icon" />
    <title>Blank Page | PlainAdmin Demo</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="./../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./../assets/css/lineicons.css" />
    <link rel="stylesheet" href="./../assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="./../assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="./../assets/css/main.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <?php include('./../components/sidebar.php'); ?>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <?php include('./../components/header.php'); ?>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title">
                                <h2>Add Category</h2>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-6">
                            <div class="breadcrumb-wrapper">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#0">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Add Category
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-style mb-30">
                            <img src="./../assets/icons/add-file.gif" alt="" class="img-fluid">
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-6">
                        <form class="card-style mb-30" action="" method="post" enctype="multipart/form-data">
                            <h6 class="mb-25">Add Category</h6>
                            <div class="input-style-1">
                                <label>Category Name</label>
                                <input type="text" placeholder="Category Name" name="name_category" />
                            </div>
                            <div class="input-style-1">
                                <label class="form-label">Image</label>
                                <div class="mb-3">
                                    <div class="mt-3 d-none" id="image-preview">
                                        <div class="card" style="max-width: 200px;">
                                            <img src="" class="card-img-top" id="preview" alt="Preview">
                                            <div class="card-body p-2">
                                                <button type="button" class="btn btn-danger btn-sm w-100" onclick="removeImage()">
                                                    <i class="lni lni-trash-can"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="form-control" type="file" name="category_img" id="categoryImage" accept="image/*" onchange="previewImage(this)">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="main-btn primary-btn btn-hover " name="submit">Add Category</button>
                            </div>
                        </form>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <!-- ========== footer start =========== -->
        <?php include('./../components/footer.php'); ?>
        <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    <script src="./../assets/js/bootstrap.bundle.min.js"></script>
    <script src="./../assets/js/Chart.min.js"></script>
    <script src="./../assets/js/dynamic-pie-chart.js"></script>
    <script src="./../assets/js/moment.min.js"></script>
    <script src="./../assets/js/fullcalendar.js"></script>
    <script src="./../assets/js/jvectormap.min.js"></script>
    <script src="./../assets/js/world-merc.js"></script>
    <script src="./../assets/js/polyfill.js"></script>
    <script src="./../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Definisikan Toast di luar kondisi
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        <?php if (isset($result)): ?>
            <?php if (!$result['status']): ?>
                Toast.fire({
                    icon: "error",
                    title: "<?php echo $result['message']; ?>"
                });
            <?php else: ?>
                Toast.fire({
                    icon: "success",
                    title: "<?php echo $result['message']; ?>"
                });
            <?php endif; ?>
        <?php endif; ?>

        function previewImage(input) {
            const preview = document.getElementById('preview');
            const imagePreview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            const input = document.getElementById('categoryImage');
            const imagePreview = document.getElementById('image-preview');
            const preview = document.getElementById('preview');

            input.value = '';
            preview.src = '';
        }
    </script>
</body>

</html>