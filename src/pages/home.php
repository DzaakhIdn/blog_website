<?php require_once("./Admin/Classes/init.php") ?>
<header class="grid grid-cols-1 lg:grid-cols-3 gap-5 w-full h-auto mt-10 px-10">
    <!-- Slider container - left side (span 2 columns) -->
    <div class="lg:col-span-2 flex flex-col gap-5">
        <!-- Main Slider -->
        <div
            class="slider_container w-full h-[367px] lg:h-[515px] overflow-hidden relative rounded-md shadow-md">
            <!-- Main slider -->
            <div class="slider flex w-full h-full">
                <!-- Slide 1 -->
                <div
                    class="slide w-full h-[367px] lg:h-[515px] bg-green-300 flex-shrink-0 relative overflow-hidden rounded-lg shadow-lg">
                    <img
                        src="./assets/card_img/card_3.jpg"
                        alt="Card Image"
                        class="w-full h-full object-cover" />
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gray-900 bg-opacity-70 text-white p-6">
                        <h3 class="font-bold text-xl lg:text-2xl leading-tight mb-2">
                            Why I Stopped Using Multiple Monitors
                        </h3>
                        <p class="text-sm lg:text-base leading-relaxed">
                            A Single Monitor Manifesto — Many Developers Believe Multiple
                            Monitors Improve Productivity...
                        </p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div
                    class="slide w-full h-[367px] lg:h-[515px] bg-green-300 flex-shrink-0 relative overflow-hidden rounded-lg shadow-lg">
                    <img
                        src="./assets/card_img/card_3.jpg"
                        alt="Card Image"
                        class="w-full h-full object-cover" />
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gray-900 bg-opacity-70 text-white p-6">
                        <h3 class="font-bold text-xl lg:text-2xl leading-tight mb-2">
                            Why I Stopped Using Multiple Monitors
                        </h3>
                        <p class="text-sm lg:text-base leading-relaxed">
                            A Single Monitor Manifesto — Many Developers Believe Multiple
                            Monitors Improve Productivity...
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation controls -->
            <button
                id="btn_left"
                class="btn_control absolute left-4 top-1/2 transform -translate-y-1/2 bg-white text-gray-800 rounded-full p-2 shadow-lg">
                <i class="ph-bold ph-caret-left"></i>
            </button>
            <button
                id="btn_right"
                class="btn_control absolute right-4 top-1/2 transform -translate-y-1/2 bg-white text-gray-800 rounded-full p-2 shadow-lg">
                <i class="ph-bold ph-caret-right"></i>
            </button>

            <!-- Dot indicators -->
            <div
                class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <span class="w-2 h-2 bg-white rounded-full cursor-pointer"></span>
                <span
                    class="w-2 h-2 bg-white opacity-50 rounded-full cursor-pointer"></span>
                <span
                    class="w-2 h-2 bg-white opacity-50 rounded-full cursor-pointer"></span>
            </div>
        </div>
    </div>

    <!-- Sidebar - right side -->
    <aside class="w-full h-fit border rounded-md p-5">
        <p
            class="font-bold text-[23px] mt-10"
            style="font-family: 'Montserrat Alternates'">
            Popular Tags
        </p>
        <div class="leader_board rounded-md flex flex-col gap-4 mt-5">
            <?php
            $tag = new Tag();
            $tags = $tag->popular_tag();
            foreach ($tags as $tag) {
            ?>
            <div class="popular_tag">
                <div class="tag">
                    <p class="font-bold text-lg text-slate-800">#<?= $tag['nama_tag'] ?></p>
                </div>
                <div class="">
                    <p
                        class="text-slate-400 text-lg font-semibold"
                        style="font-family: 'Montserrat Alternates'">
                        <?= $tag['total_articles'] ?> Post
                    </p>
                </div>
            </div>
            <?php } ?>
        </div>
    </aside>
</header>
<!-- Top Writer -->
<section class="top_writer mt-5 relative p-5 md:px-10">
    <div class="sect_title flex items-center w-full justify-between">
        <p
            class="font-semibold text-[20px] before:w-1 before:h-1 before:rounded-sm before:mr-2 before:bg-orange-500 before:content-['-'] before:text-orange-500"
            style="font-family: 'Montserrat Alternates'">
            Top Writer
        </p>
        <div class="slide_control lg:hidden flex flex-row-reverse gap-2">
            <div class="btn_control" id="btn_next">
                <i class="ph-bold ph-caret-right"></i>
            </div>
            <div class="btn_control" id="btn_prev">
                <i class="ph-bold ph-caret-left"></i>
            </div>
        </div>
    </div>
    <div class="carrousel_author pb-6 overflow-hidden">
        <?php 
        $author = new User();
        $top_user = $author->top_user();
        foreach ($top_user as $user) {
        ?>
        <div
            class="card_profile p-6 shadow-lg rounded-lg border bg-white flex flex-col items-center justify-center text-center w-full mx-auto">
            <!-- Foto Profil -->
            <div class="avatar w-24 h-24 rounded-full overflow-hidden mb-4">
                <img
                    src="<?= $user["avatar"] ? "./public/img/profile/$user[avatar]" : "./Admin/assets/images/profile/no-profile.png"; ?>"
                    alt="Profile Photo"
                    class="w-full h-full object-cover" />
            </div>

            <!-- Nama Profil -->
            <h2 class="font-bold text-lg text-slate-800"><?= $user["username"] ?></h2>
            <p class="text-slate-500 text-sm mb-4"><?= $user["job"] ?? "" ?></p>

            <!-- Statistik -->
            <div class="stats w-full flex justify-around border-t border-b py-4">
                <div class="stat">
                    <p class="font-bold text-lg text-slate-800"><?= $user["total_posts"] ?></p>
                    <p class="text-slate-500 text-sm">Postingan</p>
                </div>
                <div class="stat">
                    <p class="font-bold text-lg text-slate-800"><?= $user["total_views"] ?></p>
                    <p class="text-slate-500 text-sm">Viewers</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="actions mt-4 w-full">
                <button 
                    onclick="window.location.href='?pg=about-author&user_id=<?= base64_encode($user['id_user']) ?>'"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-md font-medium">
                    Lihat Profil
                </button>
            </div>
        </div>
        <?php } ?>
    </div>
    <div
        class="penutup_card absolute right-0 top-16 w-[171px] h-[380px] hidden md:block lg:hidden"
        style="
          background: rgb(2, 0, 36);
          background: linear-gradient(
            90deg,
            rgba(2, 0, 36, 0) 0%,
            rgba(255, 255, 255, 1) 100%
          );
        "></div>
</section>

<!-- Popular Post -->
<section class="popular_post mt-5 relative p-5 md:px-10">
    <div class="sect_title flex items-center w-full justify-between">
        <p
            class="font-semibold text-[20px] before:w-1 before:h-1 before:rounded-sm before:mr-2 before:bg-orange-500 before:content-['-'] before:text-orange-500"
            style="font-family: 'Montserrat Alternates'">
            Popular Posts
        </p>
        <div class="slide_control lg:hidden flex flex-row-reverse gap-2">
            <div class="btn_control" id="btn_next">
                <i class="ph-bold ph-caret-right"></i>
            </div>
            <div class="btn_control" id="btn_prev">
                <i class="ph-bold ph-caret-left"></i>
            </div>
        </div>
    </div>
    <div class="carrousel_post flex pb-6 overflow-hidden">
        <?php foreach ($posts as $post) : ?>
            <div class="card p-3 shadow-md flex flex-col border mt-3 mb-3 hover:shadow-lg hover:cursor-pointer" onclick="window.location.href='?pg=post&content=<?= base64_encode($post['id_post']) ?>'">
                <div class="img_card rounded-md mb-2 lg:h-[190px] overflow-hidden">
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
    <div
        class="penutup_card absolute right-0 top-16 w-[171px] h-[380px] hidden md:block lg:hidden"
        style="
          background: rgb(2, 0, 36);
          background: linear-gradient(
            90deg,
            rgba(2, 0, 36, 0) 0%,
            rgba(255, 255, 255, 1) 100%
          );
        "></div>
</section>

<!-- Popular Category -->
<section
    class="popular_category bg-slate-100 w-full h-auto mt-5 p-5 lg:p-10 md:px-10">
    <div class="judul_category mb-5">
        <p
            class="font-bold text-2xl lg:text-4xl text-slate-800 text-center mb-2"
            style="font-family: 'Montserrat Alternates'">
            Popular Category
        </p>
        <p class="text-slate-500 text-center text-[14px]">
            Kategori populer dari kami
        </p>
    </div>
    <div
        class="popular_category_container grid grid-cols-1 lg:grid-cols-2 gap-5">
        <?php
        $popular_category = new Category();
        $categories = $popular_category->category_views(4);
        foreach ($categories as $category) {
        ?>
        <div class="card_category group" onclick="window.location.href='?pg=singgle_category&category=<?= base64_encode($category['category_id']) ?>'">
            <!-- Image container -->
            <img
                src="./public/img/category_img/<?= $category["category_img"] ?>"
                alt="<?= $category["category_name"] ?>"
                class="w-14 h-14 left-5 rounded-full object-cover absolute group-hover:w-full group-hover:h-full group-hover:left-0 group-hover:scale-110 transition-all duration-500 ease-in-out" />
            <!-- Overlay untuk background gelap -->
            <div
                class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 transition-opacity duration-500"></div>

            <!-- Content -->
            <div
                class="category_content relative z-10 text-slate-800 group-hover:text-white transition-colors duration-500 ml-24">
                <h3 class="font-semibold text-lg lg:text-xl"><?= $category["category_name"] ?></h3>
                <p class="text-sm opacity-75"><?= $category["total_articles"] ?> articles</p>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="w-full flex justify-center">
        <a href="?pg=category" class="btn mt-5 flex py-2 px-4 gap-2 items-center bg-blue-400 hover:bg-blue-500 text-white justify-center">View All</a>
    </div>
</section>

<!-- Newest Post -->
<section class="popular_post mt-5 relative p-5 md:px-10">
    <div class="judul_category mb-5">
        <p
            class="font-bold text-2xl lg:text-4xl text-slate-800 text-center mb-2"
            style="font-family: 'Montserrat Alternates'">
            Newest Post
        </p>
        <p class="text-slate-500 text-center text-[14px]">
            Postingan terbaru dari kami
        </p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 pb-6 overflow-hidden">
        <?php foreach ($newest as $post) : ?>
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
<script src="./src/js/jquery-3.7.1.min.js"></script>