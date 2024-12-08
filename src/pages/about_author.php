<?php
require_once "./Admin/Classes/init.php";
$id = $_GET['user_id'];
$user = new User();
$posts = new Post();
$users = $user->find(base64_decode($id));
$user_posts = $posts->all_paginate2(base64_decode($id));
$views = $posts->count_views(base64_decode($id));
// var_dump($users);
// echo($users[0]['avatar']);
?>
<div class="breadcrumbs text-sm px-5 lg:px-10 mt-5">
  <ul>
    <li><a href="./index.html">Home</a></li>
    <li class="text-slate-400">Writer</li>
  </ul>
</div>

<header class="px-5 lg:px-10 mt-5">
  <div class="flex flex-col bg-slate-100 rounded-xl p-3 gap-5">
    <!-- Profile -->
    <div class="profile_banner hidden md:block">
      <img src="<?= $users[0]['banner'] ? "./public/img/banner/" . $users[0]['banner'] : "./assets/card_img/card_header-1.jpg"; ?>" alt="author" class="w-full h-[200px] object-cover rounded-xl" />
    </div>
    <div class="profile flex w-full gap-3">
      <div class="profile_img min-w-[75px] max-w-[75px] rounded-md overflow-hidden">
        <img
          src="<?= $users[0]['avatar'] ? "./public/img/profile/" . $users[0]['avatar'] : "./Admin/assets/images/profile/no-profile.png"; ?>"
          alt="Profile Picture"
          class="w-full h-full object-cover" />
      </div>

      <div class="flex flex-col w-full">
        <div class="profile_name flex justify-between items-center w-full">
          <p class="text-base font-medium text-slate-700"><?= $users[0]['username']; ?></p>
        </div>
        <p class="text-sm text-slate-500"><?= $users[0]['bio']; ?></p>
        <div class="profile_info flex gap-5 items-center mt-2">
          <div class="rating flex gap-2">
            <i class="fa-solid fa-eye text-slate-500"></i>
            <p class="text-sm font-medium text-slate-500"><?= $views["total_views"] ?></p>
          </div>
          <div class="posts flex gap-2">
            <i class="fa-regular fa-newspaper text-slate-500"></i>
            <p class="text-sm font-medium text-slate-500"><?= count($user_posts) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="px-5 lg:px-10 mt-5">
  <p class="text-lg  font-semibold text-slate-700">Lastest Posts</p>
  <div class="posts_container grid grid-cols-1 lg:grid-cols-4 gap-5">
    <!-- Card Post -->
    <?php foreach ($user_posts as $post) : ?>
      <div
        onclick="window.location.href='?pg=post&content=<?= base64_encode($post['id_post']) ?>'"
        class="card_post bg-white p-3 shadow-md flex flex-col md:flex-row lg:flex-col rounded-md border hover:shadow-lg hover:cursor-pointer">
        <div class="img_card w-full md:w-1/3 lg:w-full h-[186px] rounded-md mb-2 md:mb-0 lg:mb-2">
          <img src="<?= $post["image_url"] ? "./public/img/post_img/$post[image_url]" : "./assets/card_img/category_4.jpg"; ?>" alt="" class="rounded-md w-full h-full object-cover" />
        </div>
        <div class="card_content flex flex-col w-full md:w-2/3 lg:w-full justify-between md:pl-4 lg:pl-0">
          <div class="card_title mb-2">
            <p class="font-bold text-lg text-slate-800 truncate">
              <?= $post["title"] ?>
            </p>
            <div class="text-slate-500 text-[14px] line-clamp-2">
              <?= htmlspecialchars_decode($post["content"]) ?>
            </div>
          </div>
          <div class="profile_info flex items-center justify-between w-full bg-[#F5F5F5] rounded-md p-2">
            <div class="avatar_info flex w-full items-center gap-2">
              <div class="avatar">
                <div class="w-10 rounded-lg">
                  <img
                    src="<?= $post["avatar"] ? "./public/img/profile/$post[avatar]" : "./Admin/assets/images/profile/no-profile.png"; ?>"
                    alt="Tailwind-CSS-Avatar-component" />
                </div>
              </div>
              <div class="header">
                <p onclick="window.location.href='?pg=about-author&user_id=<?= base64_encode($post['user_id']) ?>'" class="font-bold text-[14px] text-slate-800"><?= $post["username"] ?></p>
                <p class="text-[12px] text-slate-700"><?= date('M d, Y', strtotime($post['created_at'])) ?></p>
              </div>
            </div>
            <div class="save_icon w-10 h-10 grid place-items-center">
              <i class="ph-bold ph-bookmark-simple text-slate-400 text-xl"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <div class="flex items-center gap-x-1 mt-5" aria-label="Pagination">
    <button type="button" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex jusify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10" aria-label="Previous">
      <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"></path>
      </svg>
      <span class="sr-only">Previous</span>
    </button>
    <div class="flex items-center gap-x-1">
      <button type="button" class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-gray-200 text-gray-800 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-300 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:text-white dark:focus:bg-neutral-500" aria-current="page">1</button>
      <button type="button" class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">2</button>
      <button type="button" class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">3</button>
      <div class="hs-tooltip inline-block">
        <button type="button" class="hs-tooltip-toggle group min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-400 hover:text-blue-600 p-2 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:bg-white/10">
          <span class="group-hover:hidden text-xs">•••</span>
          <svg class="group-hover:block hidden shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 17 5-5-5-5"></path>
            <path d="m13 17 5-5-5-5"></path>
          </svg>
          <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
            Next 4 pages
          </span>
        </button>
      </div>
      <button type="button" class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">8</button>
    </div>
    <button type="button" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex jusify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10" aria-label="Next">
      <span class="sr-only">Next</span>
      <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"></path>
      </svg>
    </button>
  </div>
</section>
<!-- ========== section end ========== -->