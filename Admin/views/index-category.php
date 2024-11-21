<?php
require_once __DIR__ . '/../Classes/init.php';

$category = new Category();

$limit = 3; // Data per page
$pageActive = isset($_GET["page"]) ? (int)$_GET["page"] : 1; // Halaman yang aktif
$length = count($category->all()); // Total data
$countPage = ceil($length / $limit);

$key = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$offset = ($pageActive - 1) * $limit;

$no = $offset + 1;

$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;

// Query dengan pagination
$categories = $category->all_paginate($offset, $limit);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h2>Category</h2>
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
                      Category
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
            <div class="card-style mb-30">
              <div class="d-flex justify-content-between align-items-center mb-20">
                <div>
                  <h6 class="mb-10">Data Kategori</h6>
                  <p class="text-sm">Berikut adalah data kategori yang ada</p>
                </div>
                <div class="d-flex gap-2 align-items-center">
                  <a href="add_category.php" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                  </a>
                  <form action="" method="get">
                    <input type="text" id="search-input" name="keyword" class="form-control " placeholder="Cari Kategori">
                  </form>
                </div>
              </div>
              <div id="bungkus-table" class="table-wrapper table-responsive">
                <?php if (empty($categories)) : ?>
                  <div class="d-flex justify-content-center m-5">
                    <div class="pesan">
                      <img src="../assets/icons/no-data.gif" alt="" width="100">
                      <p>Data tidak ditemukan</p>
                    </div>
                  </div>
                <?php else : ?>
                  <table class="table">
                    <thead>
                    <tr>
                      <th>
                        <h6>#</h6>
                      </th>
                      <th>
                        <h6>Nama Kategori</h6>
                      </th>
                      <th>
                        <h6>Attachment</h6>
                      </th>
                      <th>
                        <h6>Action</h6>
                      </th>
                    </tr>
                    <!-- end table row-->
                  </thead>
                  <tbody>
                    <?php foreach ($categories as $cat): ?>
                      <tr>
                        <td>
                          <?= $no++ ?>
                        </td>
                        <td class="min-width">
                          <p><?= $cat['name_category'] ?></p>
                        </td>
                        <td class="min-width">
                          <div class="image">
                            <img src="../../public/img/category_img/<?= $cat['category_img'] ?>" width="100" class="img-thumbnail rounded shadow-sm" alt="" />
                          </div>
                        </td>
                        <td>
                          <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                          <a href="#" class="btn btn-success"><i class="fa-solid fa-pencil"></i></a>
                        </td>
                      </tr>
                      <!-- end table row -->
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                <?php endif; ?>
                <!-- end table -->
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-end mt-4">
                    <li class="page-item <?= ($pageActive == 1) ? 'disabled' : '' ?>">
                      <a class="page-link border-0 rounded-2 me-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" href="?page=<?= $prev ?>">
                        <i class="lni lni-chevron-left"></i>
                      </a>
                    </li>

                    <?php for ($i = 1; $i <= $countPage; $i++): ?>
                      <li class="page-item <?= ($pageActive == $i) ? 'active' : '' ?>">
                        <a class="page-link border-0 rounded-2 me-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" href="?page=<?= $i ?>"><?= $i ?></a>
                      </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($pageActive == $countPage) ? 'disabled' : '' ?>">
                      <a class="page-link border-0 rounded-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;" href="?page=<?= $next ?>">
                        <i class="lni lni-chevron-right"></i>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->
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
  <script src="./../assets/js/jquery-3.7.1.min.js"></script>
  <script src="./../assets/js/bootstrap.bundle.min.js"></script>
  <script src="./../assets/js/Chart.min.js"></script>
  <script src="./../assets/js/dynamic-pie-chart.js"></script>
  <script src="./../assets/js/moment.min.js"></script>
  <script src="./../assets/js/fullcalendar.js"></script>
  <script src="./../assets/js/jvectormap.min.js"></script>
  <script src="./../assets/js/world-merc.js"></script>
  <script src="./../assets/js/polyfill.js"></script>
  <script src="./../assets/js/main.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#search-input').on('keyup', function() {
        $('#bungkus-table').load(`../search/search_category.php?keyword=` + $('#search-input').val());
      });
    });
  </script>
</body>

</html>