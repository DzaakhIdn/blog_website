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
      class="card_category group relative rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:scale-102 transition-all duration-500 cursor-pointer"
      onclick="window.location.href='?pg=singgle_category&category=<?= base64_encode($category['category_id']) ?>'"
    >
      <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-60 z-10"></div>
      <img
        src="./public/img/category_img/<?= $category["category_img"] ?>"
        alt="<?= htmlspecialchars($category["category_name"]) ?>"
        class="w-full h-64 object-cover object-center transition-transform duration-500 group-hover:scale-110"
      />
      <div class="absolute inset-0 flex flex-col justify-end p-6 z-20">
        <h3 class="text-2xl font-bold text-white mb-2 transform translate-y-2 transition-transform duration-300 group-hover:translate-y-0">
          <?= htmlspecialchars($category["category_name"]) ?>
        </h3>
        <p class="text-sm font-medium text-gray-300 opacity-0 transform translate-y-4 transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
          <?= $category["total_articles"] ?> <?= $category["total_articles"] > 1 ? 'Articles' : 'Article' ?>
        </p>
      </div>
    </div>
    <?php } ?>
  </div>
</section>