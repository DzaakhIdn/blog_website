<?php
require_once __DIR__ . '/../DB/connections.php';
require_once __DIR__ . '/../Classes/init.php';

$username = $_SESSION['username'];
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
                  <h3 class="text-bold mb-10">$74,567</h3>
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
          </div>
          <!-- End Row -->
          <div class="row">
            
          </div>
        </div>
        <!-- end container -->