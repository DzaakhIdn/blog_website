<?php
require_once __DIR__ . '/../DB/connections.php';
require_once __DIR__ . '/../Classes/init.php';

if (!isset($_SESSION["id_user"])) {
  die("Anda harus login untuk mengakses halaman ini");
} else {
  $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'"));
  $id = $user['id_user'];
  $avatar = $user['avatar'];
}

$post = new Post();
$posts = $post->all_paginate2($id);
?>
<div class="container-fluid">
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="title">
          <h2>Hallo👋🏿 , <br> Selamat Datang <?= $username ?></h2>
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
                Blog Page
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
    <div class="col-xl-3 col-lg-4 col-sm-6">
      <div class="icon-card mb-30">
        <div class="icon success">
          <i class="fa-regular fa-window-restore"></i>
        </div>
        <div class="content">
          <h6 class="mb-10">Total Post</h6>
          <h3 class="text-bold mb-10"><?= count($posts) ?></h3>
        </div>
      </div>
      <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="col-xl-3 col-lg-4 col-sm-6">
      <div class="icon-card mb-30">
        <div class="icon primary">
          <i class="fa-solid fa-eye"></i>
        </div>
        <div class="content">
          <h6 class="mb-10">Total Views</h6>
          <h3 class="text-bold mb-10">$74,567</h3>
        </div>
      </div>
      <!-- End Icon Cart -->
    </div>
    <!-- End Col -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
          <h5>Total Artikel</h5>
          <h3>25</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
          <h5>Total Kategori</h5>
          <h3>10</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
          <h5>Total Tag</h5>
          <h3>30</h3>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm text-center p-3">
          <h5>View Artikel</h5>
          <h3>1000</h3>
        </div>
      </div>
    </div>

    <!-- Artikel Terbaru & Shortcut -->
    <div class="row mb-4">
      <!-- Artikel Terbaru -->
      <div class="col-md-8">
        <h5>Artikel Terbaru</h5>
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong>Judul Artikel 1</strong>
              <p class="mb-0">Kategori: Lifestyle</p>
            </div>
            <span>12 Nov 2024</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong>Judul Artikel 2</strong>
              <p class="mb-0">Kategori: Teknologi</p>
            </div>
            <span>10 Nov 2024</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
              <strong>Judul Artikel 3</strong>
              <p class="mb-0">Kategori: Pendidikan</p>
            </div>
            <span>8 Nov 2024</span>
          </li>
        </ul>
      </div>
      <!-- Shortcut -->
      <div class="col-md-4">
        <h5>Shortcut</h5>
        <div class="d-grid gap-3">
          <a href="#" class="btn btn-primary">Buat Artikel Baru</a>
          <a href="#" class="btn btn-outline-secondary">Kelola Kategori</a>
          <a href="#" class="btn btn-outline-secondary">Kelola Tag</a>
        </div>
      </div>
    </div>

    <!-- Grafik Aktivitas atau Artikel Favorit -->
    <div class="row">
      <div class="col-12">
        <h5>Artikel Favorit</h5>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Views</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Judul Artikel A</td>
                <td>Teknologi</td>
                <td>500</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Judul Artikel B</td>
                <td>Pendidikan</td>
                <td>300</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Judul Artikel C</td>
                <td>Lifestyle</td>
                <td>200</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Row -->
  <div class="row">

  </div>
</div>
<!-- end container -->