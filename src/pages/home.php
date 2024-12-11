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
            <h1 class="text-4xl font-bold text-white sm:text-6xl lg:text-5xl leading-tight">
                <span class="block">Welcome to</span>
                <span class="block mt-2 bg-gradient-to-r from-orange-400 to-orange-600 text-transparent bg-clip-text animate-gradient pb-2">Blog.my</span>
            </h1>

            <p class="mt-6 max-w-lg text-gray-300 text-lg sm:text-xl leading-relaxed">
                Buat blog terbaik untuk membangun dan memperkaya hidupmu
            </p>

            <div class="mt-8 flex items-center space-x-4">
                <?php $user = new User(); $users = $user->all(); $user_limit = $user->all_limit(3) ?>
                <div class="flex -space-x-2">
                    <?php foreach($user_limit as $user) : ?>
                    <img class="w-10 h-10 rounded-full border-2 border-white" src="<?= $user["avatar"] ? "./public/img/profile/$user[avatar]" : "./Admin/assets/images/profile/no-profile.png"; ?>" alt="User">
                    <?php endforeach; ?>
                </div>
                <span class="text-sm text-gray-300">Join <?= count($users) ?> others who are already using Blog.my</span>
            </div>

            <div class="mt-8 flex flex-wrap gap-4 text-center">
                <a
                    href="./Admin/index.php"
                    class="block w-full rounded bg-orange-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-orange-700 focus:outline-none focus:ring active:bg-orange-500 sm:w-auto">
                    Get Started
                </a>

                <a
                    href="?pg=about"
                    class="block w-full rounded bg-white px-12 py-3 text-sm font-medium text-orange-600 shadow hover:text-orange-700 focus:outline-none focus:ring active:text-orange-500 sm:w-auto">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Top Writer -->
<section class="bg-gray-50">
    <div class="mx-auto max-w-[1340px] px-4 py-12 sm:px-6 lg:me-0 lg:py-16 lg:pe-0 lg:ps-8 xl:py-24">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3 lg:items-center lg:gap-16">
            <div class="max-w-xl ltr:sm:text-left rtl:sm:text-right">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Top-Tier Authors Showcase
                </h2>

                <p class="mt-4 text-gray-700 max-w-2xl">
                    Discover our top-tier authors who have contributed to our platform and are known for their exceptional writing skills.
                </p>

                <div class="mt-6 flex items-center">
                    <span class="inline-block h-1 w-10 bg-orange-500 rounded-full"></span>
                    <span class="ml-3 text-sm font-medium text-orange-500">Curated Excellence</span>
                </div>

                <div class="hidden lg:mt-8 lg:flex lg:gap-4">
                    <button
                        aria-label="Previous slide"
                        id="keen-slider-previous-desktop"
                        class="rounded-full border border-orange-600 p-3 text-orange-600 transition hover:bg-orange-600 hover:text-white">
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
                        class="rounded-full border border-orange-600 p-3 text-orange-600 transition hover:bg-orange-600 hover:text-white">
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
                    <div class="keen-slider__slide p-2">
                        <blockquote class="flex h-full flex-col justify-between shadow-md bg-white p-6 sm:p-8 lg:p-12 rounded-lg">
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
                                    <p class="text-2xl font-bold text-orange-600 sm:text-3xl mb-4">About Me</p>

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
                class="rounded-full border border-orange-600 p-4 text-orange-600 transition hover:bg-orange-600 hover:text-white">
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
                class="rounded-full border border-orange-600 p-4 text-orange-600 transition hover:bg-orange-600 hover:text-white">
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
        <h2 class="font-bold text-2xl lg:text-3xl text-slate-800 mb-4 flex items-center font-montserrat">
            <span class="w-2 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-full mr-3" aria-hidden="true"></span>
            Trending Articles
            <span class="ml-3 text-sm font-normal text-orange-500 bg-orange-100 px-2 py-1 rounded-full inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
                Trending
            </span>
        </h2>
        <p class="text-slate-600 mb-6 max-w-3xl">
            Discover our most popular and engaging content, handpicked for you. These articles have captivated our community with their insightful perspectives and timely relevance.
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
    <div class="mb-10 text-center">
        <h2 class="font-montserrat font-bold text-3xl lg:text-5xl text-slate-800 mb-3 relative inline-block">
            Explore Popular Categories
        </h2>
        <p class="text-slate-600 text-lg max-w-2xl mx-auto">
            Discover trending topics and join vibrant discussions in our most active categories
        </p>
        <div class="mt-4 flex justify-center space-x-2">
            <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Hot</span>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Trending</span>
        </div>
    </div>
    <div
        class="popular_category_container grid grid-cols-1 lg:grid-cols-2 gap-5">
        <?php
        $popular_category = new Category();
        $categories = $popular_category->category_views(4);
        foreach ($categories as $category) {
        ?>
            <div class="card_category group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 cursor-pointer" onclick="window.location.href='?pg=singgle_category&category=<?= base64_encode($category['category_id']) ?>'">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-pink-500 to-orange-400 opacity-0 group-hover:opacity-80 transition-opacity duration-500 ease-in-out"></div>
                
                <img
                    src="./public/img/category_img/<?= $category["category_img"] ?>"
                    alt="<?= htmlspecialchars($category["category_name"]) ?>"
                    class="w-full h-56 object-cover transition-transform duration-500 ease-out group-hover:scale-110"
                    loading="lazy"
                />
                
                <div class="absolute inset-0 flex flex-col justify-end p-6 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"><?= htmlspecialchars($category["category_name"]) ?></h3>
                    <p class="text-sm text-gray-200 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                        <span class="inline-block bg-white/20 rounded-full px-3 py-1 backdrop-blur-sm">
                            <?= number_format($category["total_articles"]) ?> articles
                        </span>
                    </p>
                </div>
                
                <div class="absolute top-4 right-4 bg-white/30 rounded-full p-2 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-x-2 group-hover:translate-x-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
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
    <div class="section-header text-center mb-8">
        <h2 class="font-montserrat-alternates font-bold text-2xl lg:text-4xl text-slate-800 mb-3">
            Latest Insights
        </h2>
        <p class="text-slate-600 text-sm lg:text-base max-w-2xl mx-auto">
            Discover our freshest content, hot off the press and ready to inspire
        </p>
        <div class="mt-4 flex justify-center space-x-2">
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">New</span>
            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Updated</span>
        </div>
    </div>
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