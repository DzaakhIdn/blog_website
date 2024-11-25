<?php
require_once __DIR__ . '/../Classes/init.php';

$category = new Category();

$key = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$categories = $category->search($key); // Fungsi search berdasarkan keyword
?>

<!-- Tabel atau Data Kategori -->
<?php if (empty($categories)): ?>
  <div class="d-flex justify-content-center m-5">
    <div class="pesan">
      <img src="../assets/icons/no-data.gif" alt="" width="100">
      <p>Data tidak ditemukan</p>
    </div>
  </div>
<?php else: ?>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama Kategori</th>
        <th>Attachment</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($categories as $cat): ?>
        <tr>
          <td></td>
          <td><?= $cat['name_category'] ?></td>
          <td>
            <img src="./../assets/images/lead/lead-1.png" width="100" class="img-thumbnail rounded shadow-sm" alt="">
          </td>
          <td>
            <a href="#" class="btn bg-danger"><i class="fa-solid fa-trash text-white"></i></a>
            <a href="#" class="btn bg-success"><i class="fa-solid fa-pencil text-white"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
