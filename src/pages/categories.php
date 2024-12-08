<?php require_once("./Admin/Classes/init.php") ?>
<div class="breadcrumbs text-sm px-5 lg:px-8 mt-5">
  <ul>
    <li><a>Home</a></li>
    <li class="text-slate-400">Categories</li>
  </ul>
</div>

<section class="categories_container p-6">
  <div
    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <!-- Card Category -->
     <?php 
     $category = new Category();
     $categories = $category->category_views();
     foreach ($categories as $category) {
     ?>
    <div
      class="card_category h-[250px] relative rounded-lg overflow-hidden shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer"
      onclick="window.location.href='?pg=singgle_category&category=<?= base64_encode($category['category_id']) ?>'"
      >
      <img
        src="./public/img/category_img/<?= $category["category_img"] ?>"
        alt="Category Image"
        class="absolute inset-0 w-full h-full object-cover opacity-50" />
      <div
        class="absolute inset-0 flex items-center flex-col justify-center bg-black bg-opacity-60 text-white text-xl font-semibold">
        <p><?= $category["category_name"] ?></p>
        <p class="text-sm font-normal"><?= $category["total_articles"] ?> Postingan</p>
      </div>
    </div>
    <?php } ?>
  </div>
</section>