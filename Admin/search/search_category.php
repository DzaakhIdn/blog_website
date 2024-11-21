<?php
require_once __DIR__ . '/../Classes/init.php';
$keyword = $_GET['keyword'];
$category = new Category();

$categories = "";

$limit = 3;
$pageActive = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$key = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$offset = ($pageActive - 1) * $limit;
$length = $key !== '' ? count($category->search($key)) : count($category->all());
$countPage = ceil($length / $limit);

$no = $offset + 1;

$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;

$categories = $key !== '' ? $category->search($key, $offset, $limit) : $category->all_paginate($offset, $limit);
?>
<div id="bungkus-table" class="table-wrapper table-responsive">
    <?php if (empty($categories)) : ?>
        <div class="d-flex justify-content-center align-items-center min-vh-50 m-5">
            <div class="pesan text-center">
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