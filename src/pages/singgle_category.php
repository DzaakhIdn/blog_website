<?php
require_once("./Admin/Classes/init.php");
$id = $_GET['category'];
$category = new Post();
$categories_id = $category->post_cagtegory(base64_decode($id));
// var_dump($categories_id);
?>
<div class="breadcrumbs text-sm px-5 lg:px-10 mt-5">
  <ul>
    <li><a href="./index.php">Home</a></li>
    <li><a href="?pg=category">Categories</a></li>
    <li class="text-slate-400"><?= $categories_id[0]['name_category'] ?></li>
  </ul>
</div>

<section class="categories_container p-6">
  <div
    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php foreach ($categories_id as $post) : ?>
    <!-- Card Category -->
    <div class="card p-3 shadow-md flex flex-col border mt-3 mb-3 hover:shadow-lg hover:cursor-pointer" onclick="window.location.href='?pg=post&content=<?= base64_encode($post['id_post']) ?>'">
                <div class="img_card rounded-md mb-2 lg:h-[160px] overflow-hidden">
                    <img
                        src="./public/img/post_img/<?= $post['image_url']; ?>"
                        alt="Card Image"
                        class="rounded-md w-full h-full object-cover" />
                </div>
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
                            <p class="font-bold text-[14px] text-slate-800"><?= $post["username"] ?></p>
                            <p class="text-[12px] text-slate-700"><?= date('M d, Y', strtotime($post['created_at'])) ?></p>
                        </div>
                    </div>
                    <div class="save_icon w-10 h-10 grid place-items-center">
                        <i class="ph-bold ph-bookmark-simple text-slate-400 text-xl"></i>
                    </div>
                </div>
            </div>
    <?php endforeach; ?>
  </div>
</section>