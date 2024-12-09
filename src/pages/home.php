<?php require_once("./Admin/Classes/init.php") ?>
<!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<!--
  Heads up! 👋

  This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
-->

<section class="relative">
    <div id="slider_for" class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1604014237800-1c9102c219da?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
            alt="Background Image"
            class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gray-900/75 bg-gradient-to-r from-gray-900/95 to-gray-900/25"></div>
    </div>

    <div
        class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
        <div class="max-w-xl ltr:sm:text-left rtl:sm:text-right">
            <h1 class="text-3xl font-extrabold text-white sm:text-5xl">
                Let us find your

                <strong class="block font-extrabold text-rose-500"> Forever Home. </strong>
            </h1>

            <p class="mt-4 max-w-lg text-white sm:text-xl/relaxed">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt illo tenetur fuga ducimus
                numquam ea!
            </p>

            <div class="mt-8 flex flex-wrap gap-4 text-center">
                <a
                    href="#"
                    class="block w-full rounded bg-rose-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-rose-700 focus:outline-none focus:ring active:bg-rose-500 sm:w-auto">
                    Get Started
                </a>

                <a
                    href="#"
                    class="block w-full rounded bg-white px-12 py-3 text-sm font-medium text-rose-600 shadow hover:text-rose-700 focus:outline-none focus:ring active:text-rose-500 sm:w-auto">
                    Learn More
                </a>
            </div>

            <div class="mt-10">
                <h2 class="text-lg font-medium text-white mb-4">Popular Tags</h2>
                <div id="slider_nav" class="flex flex-wrap gap-2">
                    <span class="bg-gray-800 text-gray-300 px-3 py-1 rounded-full text-sm">#RealEstate</span>
                    <span class="bg-gray-800 text-gray-300 px-3 py-1 rounded-full text-sm">#DreamHome</span>
                    <span class="bg-gray-800 text-gray-300 px-3 py-1 rounded-full text-sm">#ForeverHome</span>
                    <span class="bg-gray-800 text-gray-300 px-3 py-1 rounded-full text-sm">#LuxuryLiving</span>
                    <span class="bg-gray-800 text-gray-300 px-3 py-1 rounded-full text-sm">#Affordable</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Top Writer -->
<section class="bg-gray-50">
    <div class="mx-auto max-w-[1340px] px-4 py-12 sm:px-6 lg:me-0 lg:py-16 lg:pe-0 lg:ps-8 xl:py-24">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-center lg:gap-16">
            <div class="max-w-xl ltr:sm:text-left rtl:sm:text-right">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Author Papan Atas Bro...
                </h2>

                <p class="mt-4 text-gray-700">
                    ini adalah kumpulan author papan atas !
                </p>

                <div class="hidden lg:mt-8 lg:flex lg:gap-4">
                    <button
                        aria-label="Previous slide"
                        id="keen-slider-previous-desktop"
                        class="rounded-full border border-rose-600 p-3 text-rose-600 transition hover:bg-rose-600 hover:text-white">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5 rtl:rotate-180">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <button
                        aria-label="Next slide"
                        id="keen-slider-next-desktop"
                        class="rounded-full border border-rose-600 p-3 text-rose-600 transition hover:bg-rose-600 hover:text-white">
                        <svg
                            class="size-5 rtl:rotate-180"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 5l7 7-7 7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="-mx-6 lg:col-span-2 lg:mx-0">
                <div id="keen-slider" class="keen-slider">
                    <?php
                    $users = new User();
                    $top_author = $users->top_user();
                    foreach ($top_author as $author) { 
                    ?>
                    <div class="keen-slider__slide">
                        <blockquote class="flex h-full flex-col justify-between bg-white p-6 shadow-sm sm:p-8 lg:p-12 rounded-lg">
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="<?= $author["avatar"] ? "./public/img/profile/$author[avatar]" : "./Admin/assets/images/profile/no-profile.png"; ?>" alt="Author Profile" class="w-12 h-12 rounded-full object-cover">
                                        <div>
                                            <p class="font-semibold text-gray-800"><?= $author['username'] ?></p>
                                            <p class="text-sm text-gray-500"><?= $author['job'] ?></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 text-gray-500">
                                        <i class="fas fa-eye"></i>
                                        <span class="text-sm"><?= $author['total_views'] ?> views</span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-rose-600 sm:text-3xl mb-4">Stayin' Alive</p>

                                    <p class="leading-relaxed text-gray-700">
                                        <?= $author['bio'] ?>
                                    </p>
                                </div>
                            </div>

                            <footer class="mt-4 flex justify-between items-center">
                                <div class="flex items-center space-x-2 text-gray-500">
                                    <i class="fas fa-newspaper"></i>
                                    <span class="text-sm"><?= $author['total_posts'] ?> Artikel</span>
                                </div>
                                <div class="text-sm font-medium text-gray-700">
                                    &mdash; Join on <?= date('d M Y', strtotime($author['created_at_user'])) ?>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center gap-4 lg:hidden">
            <button
                aria-label="Previous slide"
                id="keen-slider-previous"
                class="rounded-full border border-rose-600 p-4 text-rose-600 transition hover:bg-rose-600 hover:text-white">
                <svg
                    class="size-5 -rotate-180 transform"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>

            <button
                aria-label="Next slide"
                id="keen-slider-next"
                class="rounded-full border border-rose-600 p-4 text-rose-600 transition hover:bg-rose-600 hover:text-white">
                <svg
                    class="size-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>
        </div>
    </div>
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
            <div class="card p-3 shadow-md flex flex-col border hover:shadow-lg hover:cursor-pointer" onclick="window.location.href='?pg=post&content=<?= base64_encode($post['id_post']) ?>'">
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