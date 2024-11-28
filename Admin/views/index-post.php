<?php
session_start();
require_once __DIR__ . '/../Classes/init.php';
require_once __DIR__ . '/../DB/connections.php';

$post = new Post();
if(!isset($_SESSION["id_user"])){
  die("Anda harus login untuk mengakses halaman ini");
} else {
  $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'"));
  $id = $user['id_user'];
  $avatar = $user['avatar'];
}

$limit = 3; // Data per page
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Halaman yang aktif
$length = count($post->all()); // Total data
$countPage = ceil($length / $limit);

$key = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$offset = ($pageActive - 1) * $limit;

$no = $offset + 1;

$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;

// Query dengan pagination
$posts = $post->all_paginate2($id, $offset, $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./../assets/images/favicon.svg" type="image/x-icon" />
  <title>Blog Post | Dashboard Admin</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="./../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./../assets/css/lineicons.css" />
  <link rel="stylesheet" href="./../assets/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="./../assets/css/fullcalendar.css" />
  <link rel="stylesheet" href="./../assets/css/main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
  .image-container {
    position: relative;
  }

  .hover-options {
    opacity: 0;
    background: rgba(0, 0, 0, 0.5);
    /* Background overlay */
    transition: opacity 0.3s ease;
  }

  .image-container:hover .hover-options {
    opacity: 1;
  }

  .hover-options i {
    font-size: 1.5rem;
    cursor: pointer;
    transition: transform 0.2s ease;
  }

  .hover-options i:hover {
    transform: scale(1.2);
  }
</style>

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
                <h2>Blog Post</h2>
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
                      Blog Post
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
          <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center mb-20">
              <div>
                <h6 class="mb-10">Postingan Blog</h6>
                <p class="text-sm">Postingan Blog yang udah kamu buat :></p>
              </div>
              <div class="d-flex gap-2 align-items-center">
                <form action="" method="get">
                  <input type="text" id="search-input" name="keyword" class="form-control " placeholder="cari blog">
                </form>
                <a href="index.php?pg=posts" class="btn btn-primary d-flex align-items-center gap-2 justify-content-center">
                  <i class="fa-solid fa-plus"></i>
                  add post
                </a>
              </div>
            </div>
            <div>
            <?php if (empty($posts)) : ?>
              <div class="d-flex justify-content-center align-items-center min-vh-50 m-5">
                <div class="pesan text-center">
                  <img src="../assets/images/empty.png" alt="" width="350">
                  <p>Data tidak ditemukan</p>
                </div>
              </div>
            <?php else : ?>
            <div id="card_container" class="row g-3">
              <?php foreach ($posts as $pos) : ?>
                <div class="col-lg-4">
                  <div class="card p-3 shadow-sm border rounded">
                    <div class="image-container position-relative mb-3 overflow-hidden rounded">
                      <img
                        src="../../public/img/post_img/<?= $pos['image_url'] ?>"
                        alt=""
                        class="img-fluid rounded"
                        style="height: 12rem; object-fit: cover; width: 100%;" />
                      <div class="hover-options position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center gap-3">
                        <i class="fa-solid fa-eye text-white bg-primary py-2 px-3 rounded small"></i>
                        <i class="fa-solid fa-pen-to-square text-white bg-success py-2 px-3 rounded small"></i>
                        <i class="fa-solid fa-trash text-white bg-danger py-2 px-3 rounded small"></i>
                      </div>
                    </div>
                    <div class="mb-3">
                      <h5 class="fw-bold text-dark"><?= $pos['title'] ?></h5>
                      <div class="small" style="max-width: 250px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        <?= htmlspecialchars_decode($pos['content']) ?>
                      </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between bg-light rounded p-2">
                      <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle overflow-hidden" style="width: 40px; height: 40px;">
                          <img src="<?php echo isset($avatar) ? "../../public/img/profile/$avatar" : "./../assets/images/profile/no-profile.png"; ?>" alt=""  class="img-fluid rounded-circle"/>
                        </div>
                        <div>
                          <p class="fw-bold mb-0 text-dark small"><?= $pos['username'] ?></p>
                          <p class="text-muted small mb-0">July 14, 2024</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="fa-regular fa-bookmark"></i>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
            </div>
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
</body>

</html>