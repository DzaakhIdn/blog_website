<?php
require_once("./Admin/DB/connections.php");
require_once("./Admin/Classes/init.php");
$post = new Post();
$id = $_GET['content'];
$posts_id = $post->find(base64_decode($id));
$posts = $post->singgle_post(base64_decode($id));
$tags = $post->find_tag(base64_decode($id));
$tags_name = array_column($tags, 'name_tag');
$id_user = $posts['user_id'];
$all_post = $post->all_paginate2($id_user);
$sql_add_Views = "UPDATE blog_posts SET views = views + 1 WHERE id_post = " . base64_decode($id);
mysqli_query($conn, $sql_add_Views);
$popular_post = $post->filter_data(null, 'views', 'DESC', 4);
$sql_random = "SELECT blog_posts.*, users.username, users.avatar FROM blog_posts JOIN users ON blog_posts.user_id = users.id_user ORDER BY RAND() LIMIT 4";
$result_random = mysqli_query($conn, $sql_random);
$random_post = mysqli_fetch_all($result_random, MYSQLI_ASSOC);
// var_dump($posts["user_id"]);
?>
<title>Blog | <?= $posts['title']; ?></title>
<div class="breadcrumbs text-sm px-5 lg:px-8 mt-5">
  <ul>
    <li><a>Home</a></li>
    <li><a>Featured</a></li>
    <li class="text-slate-400"><?= $posts['title']; ?></li>
  </ul>
</div>

<!-- Main Content -->
<main class="main_content px-5 lg:px-8 mt-5 lg:flex lg:gap-7 ">
  <div class="main_content_container flex flex-col gap-5 lg:max-w-[70%]">
    <h1 class="text-2xl lg:text-[50px] text-slate-700 font-bold w-3/4 leading-none" style="font-family: 'Raleway';">
      <?= $posts['title']; ?>
    </h1>
    <div class="main_content_container_img rounded-xl overflow-hidden">
      <img
        src="./public/img/post_img/<?= $posts['image_url']; ?>"
        alt="<?= $posts['title']; ?>"
        class="w-full h-full object-cover" />
    </div>
    <div class="post_status flex gap-2 justify-evenly items-center">
      <div class="uploaded_date flex gap-2 items-center">
        <i class="fa-regular fa-calendar text-slate-500"></i>
        <p class="text-slate-500"><?= date('M d, Y', strtotime($posts['created_at'])) ?></p>
      </div>
      <div class="comments flex gap-2 items-center">
        <i class="fa-solid fa-eye text-slate-500"></i>
        <p class="text-slate-500"><?= $posts['views']; ?></p>
      </div>
      <div class="category flex gap-2 items-center">
        <i class="fa-solid fa-tags text-slate-500"></i>
        <p class="text-slate-500"><?= $posts['name_category']; ?></p>
      </div>
    </div>
    <div class="content">
      <?= htmlspecialchars_decode($posts['content']); ?>
    </div>
    <div class="comments_lg px-5 mt-7 hidden lg:block">
      <div class="comments_container">
        <p class="font-semibold text-slate-700 text-2xl">Comments</p>
        <div class="comment_card space-y-3 mt-5 bg-slate-100 rounded-lg p-3">
          <div class="profile_comment flex justify-between gap-3">
            <div class="left_profile flex gap-3">
              <div
                class="profile_comment_img rounded-md w-[60px] h-[60px] bg-cover bg-center overflow-hidden">
                <img
                  src="../../assets/card_img/card_1.jpg"
                  alt="Profile Comment"
                  class="w-full h-full object-cover" />
              </div>
              <div class="flex flex-col gap-2">
                <p class="text-slate-700 font-semibold text-[16px]">Cassie</p>
                <div class="created_at flex gap-2 items-center">
                  <i class="fa-regular fa-calendar text-slate-500"></i>
                  <p class="text-slate-500 text-[16px]">July 14, 2024</p>
                </div>
              </div>
            </div>
            <div
              id="btn_reply"
              class="right_profile flex gap-2 items-center bg-slate-200 rounded-lg px-3 py-1">
              <i class="fa-solid fa-reply text-slate-500"></i>
              <p class="text-slate-500 text-[16px]">reply</p>
            </div>
          </div>
          <p class="text-slate-700 text-[16px]">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
            quos.
          </p>
        </div>
        <div class="comment_card space-y-3 mt-5 bg-slate-100 rounded-lg p-3">
          <div class="profile_comment flex justify-between gap-3">
            <div class="left_profile flex gap-3">
              <div
                class="profile_comment_img rounded-md w-[60px] h-[60px] bg-cover bg-center overflow-hidden">
                <img
                  src="../../assets/card_img/card_3.jpg"
                  alt="Profile Comment"
                  class="w-full h-full object-cover" />
              </div>
              <div class="flex flex-col gap-2">
                <p class="text-slate-700 font-semibold text-[16px]">Cassie</p>
                <div class="created_at flex gap-2 items-center">
                  <i class="fa-regular fa-calendar text-slate-500"></i>
                  <p class="text-slate-500 text-[16px]">July 14, 2024</p>
                </div>
              </div>
            </div>
            <div
              id="btn_reply"
              class="right_profile flex gap-2 items-center bg-slate-200 rounded-lg px-3 py-1">
              <i class="fa-solid fa-reply text-slate-500"></i>
              <p class="text-slate-500 text-[16px]">reply</p>
            </div>
          </div>
          <p class="text-slate-700 text-[16px]">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
            quos.
          </p>
        </div>
      </div>

      <div class="comment_form mt-7 space-y-3">
        <p class="font-semibold text-slate-700 text-2xl">Leave a Comment</p>
        <form action="" class="flex flex-col gap-3">
          <textarea
            name=""
            id=""
            class="textarea textarea-bordered w-full bg-slate-100"
            cols="30"
            rows="10"
            placeholder="Write your comment here..."></textarea>
        </form>
        <div class="md:flex md:items-start justify-between gap-5">
          <div class="rate bg-slate-100 rounded-lg p-3 md:w-2/3">
            <div class="flex justify-between items-center">
              <p class="font-semibold text-slate-700 text-lg md:text-xl">
                Rate this post
              </p>
              <div class="rate_container flex justify-between items-center gap-3">
                <button
                  class="rating-btn flex items-center space-x-2 text-[#FC5C65] rounded-lg px-3 py-2 transition-all"
                  data-rating="Bad"
                  data-color="bg-[#FC5C65]">
                  <i class="fa-regular fa-face-angry text-2xl"></i>
                  <span class="rating-label hidden">Bad</span>
                </button>
                <button
                  class="rating-btn flex items-center space-x-2 text-[#FA8231] rounded-lg px-3 py-2 transition-all"
                  data-rating="Not Good"
                  data-color="bg-[#FA8231]">
                  <i class="fa-regular fa-face-meh text-2xl"></i>
                  <span class="rating-label hidden">Meh</span>
                </button>
                <button
                  class="rating-btn flex items-center space-x-2 text-[#F7B731] rounded-lg px-3 py-2 transition-all"
                  data-rating="Neutral"
                  data-color="bg-[#F7B731]">
                  <i class="fa-regular fa-face-laugh text-2xl"></i>
                  <span class="rating-label hidden">Neutral</span>
                </button>
                <button
                  class="rating-btn flex items-center space-x-2 text-[#45AAF2] rounded-lg px-3 py-2 transition-all"
                  data-rating="Good"
                  data-color="bg-[#45AAF2]">
                  <i class="fa-regular fa-face-grin-hearts text-2xl"></i>
                  <span class="rating-label hidden">Good</span>
                </button>
                <button
                  class="rating-btn flex items-center space-x-2 text-[#26DE81] rounded-lg px-3 py-2 transition-all"
                  data-rating="Excellent"
                  data-color="bg-[#26DE81]">
                  <i class="fa-regular fa-face-grin-stars text-2xl"></i>
                  <span class="rating-label hidden">Excellent</span>
                </button>
              </div>
            </div>
          </div>
          <button
            id="btn_submit"
            class="bg-[#F81539]/75 text-white rounded-lg px-3 py-4 flex gap-2 items-center justify-center md:w-1/3">
            <i class="fa-solid fa-comment-dots text-base"></i>
            <p class="text-[14px]">Send Comment</p>
          </button>
        </div>
      </div>

      <div class="flex justify-end mt-5 lg:hidden">
        <button
          id="btn_submit"
          class="bg-[#F81539]/75 text-white rounded-lg px-3 py-4 flex gap-2 items-center justify-center">
          <i class="fa-solid fa-comment-dots text-base"></i>
          <p class="text-base">Send Comment</p>
        </button>
      </div>
    </div>
  </div>
  <aside class="hidden lg:block lg:w-[30%]">
    <div class="sticky top-5 flex flex-col gap-5">
      <div class="action_aside">
        <div class="action flex gap-2 justify-between items-center mt-5 md:mt-0">
          <button
            id="btn_share"
            class="w-full flex gap-2 items-center justify-center bg-slate-200 rounded-xl py-3 px-3">
            <i class="fa-regular fa-paper-plane text-slate-500"></i>
            <p class="text-slate-500">Share</p>
          </button>
          <button
            id="btn_comments"
            class="w-full flex gap-2 items-center justify-center bg-slate-200 rounded-xl py-3 px-3">
            <i class="fa-regular fa-comment-dots text-slate-500"></i>
            <p class="text-slate-500">Comment</p>
          </button>
          <button
            id="btn_mark"
            class="w-full flex gap-2 items-center justify-center bg-slate-200 rounded-xl py-3 px-3">
            <i class="fa-regular fa-bookmark text-slate-500"></i>
            <p class="text-slate-500">Marked</p>
          </button>
        </div>
      </div>
      <div class="profile_aside">
        <div
          class="profile_author flex w-full justify-between rounded-lg bg-slate-100 p-3">
          <div class="profile flex gap-3">
            <div
              class="profile_author_img hover:cursor-pointer  rounded-md w-[87px] h-[87px] bg-cover bg-center overflow-hidden">
              <img
                src="<?= $posts['avatar'] ? "./public/img/profile/$posts[avatar]" : "./Admin/assets/images/profile/no-profile.png"; ?>"
                alt="Profile Author"
                class="w-full h-full object-cover" />
            </div>
            <div class="flex flex-col gap-3">
              <a href="?pg=about-author&user_id=<?= base64_encode($id_user) ?>" class="font-semibold text-slate-700 text-lg"><?= $posts['username'] ?></a>
              <div
                id="btn_follow"
                class="bg-[#F81539]/75 rounded-lg px-3 py-1 flex gap-2 items-center">
                <i class="ph-bold ph-plus text-white text-[16px]"></i>
                <p class="text-white text-[16px]">view</p>
              </div>
            </div>
          </div>
          <p class="text-slate-500 text-[14px] self-start"><?= count($all_post) ?> Post</p>
        </div>
      </div>
      <div class="tags_aside bg-slate-100 rounded-lg p-3">
        <p class="font-semibold text-slate-700 text-base">Related Tags</p>
        <div class="tags_container flex gap-2 flex-wrap">
          <?php foreach ($tags as $tag) : ?>
            <p class="tag text-[13px] bg-slate-600 px-2 py-1 rounded-md text-white">
              <?= $tag['name_tag'] ?>
            </p>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="popular_aside bg-slate-100 rounded-lg p-3 space-y-5">
        <p class="font-semibold text-slate-700 text-base">Popular Post</p>
        <div class="popular_post flex flex-col gap-4">
          <?php foreach ($popular_post as $post) : ?>
            <div class="card_popular flex gap-3 items-start" onclick="window.location.href='?pg=post&content=<?= base64_encode($post['id_post']) ?>'" style="cursor: pointer;">
              <div class="img_card rounded-md w-[87px] h-[87px] flex-shrink-0">
                <img
                  src="./public/img/post_img/<?= $post['image_url']; ?>"
                  alt="Popular Post"
                  class="rounded-md w-full h-full object-cover" />
              </div>
              <div class="card_title">
                <p class="font-semibold text-lg text-slate-800 line-clamp-1"><?= $post['title'] ?></p>
                <div class="text-slate-500 text-[14px] line-clamp-2"><?= htmlspecialchars_decode($post['content']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </aside>
  <div class="author_mobile space-y-3 mt-5 lg:hidden">
    <div class="tags rounded-lg p-3">
      <p class="font-semibold text-slate-700 text-base">Related Tags</p>
      <div class="tags_container flex gap-2 flex-wrap">
        <?php foreach ($tags_name as $tag) : ?>
          <p class="tag text-[13px] bg-slate-600 px-2 py-1 rounded-md text-white">
            <?= $tag ?>
          </p>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="action flex gap-2 justify-between items-center">
      <button
        id="btn_share"
        class="w-full flex gap-2 items-center justify-center bg-slate-200 rounded-xl py-3 px-3">
        <i class="fa-regular fa-paper-plane text-slate-500"></i>
        <p class="text-slate-500">Share</p>
      </button>
      <button
        id="btn_comments"
        class="w-full flex gap-2 items-center justify-center bg-slate-200 rounded-xl py-3 px-3">
        <i class="fa-regular fa-comment-dots text-slate-500"></i>
        <p class="text-slate-500">Comment</p>
      </button>
      <button
        id="btn_mark"
        class="w-full flex gap-2 items-center justify-center bg-slate-200 rounded-xl py-3 px-3">
        <i class="fa-regular fa-bookmark text-slate-500"></i>
        <p class="text-slate-500">Marked</p>
      </button>
    </div>
    <div class="profile">
      <div
        class="profile_author flex w-full justify-between rounded-lg bg-slate-100 p-3">
        <div class="profile flex gap-3" onclick="window.location.href='?pg=about-author&user_id=<?= base64_encode($user['id_user']) ?>'" style="cursor: pointer;">
          <div
            class="profile_author_img hover:cursor-pointer rounded-md w-[87px] h-[87px] bg-cover bg-center overflow-hidden">
            <img
              src="<?= $posts['avatar'] ? "./public/img/profile/$posts[avatar]" : "./Admin/assets/images/profile/no-profile.png"; ?>"
              alt="Profile Author"
              class="w-full h-full object-cover" />
          </div>
          <div class="flex flex-col gap-3">
            <a href="?pg=about-author&user_id=<?= base64_encode($id_user) ?>" class="font-semibold text-slate-700 text-lg"><?= $posts['username'] ?></a>
            <div
              id="btn_follow"
              class="bg-[#F81539]/75 rounded-lg px-3 py-1 flex gap-2 items-center">
              <i class="ph-bold ph-plus text-white text-[16px]"></i>
              <p class="text-white text-[16px]">follow</p>
            </div>
          </div>
        </div>
        <p class="text-slate-500 text-[14px] self-start"><?= count($all_post) ?> Post</p>
      </div>
    </div>
  </div>
</main>
<!-- Comments -->
<section class="comments px-5 mt-7 lg:hidden ">
  <div class="comments_container">
    <p class="font-semibold text-slate-700 text-2xl">Comments</p>
    <div class="comment_card space-y-3 mt-5 bg-slate-100 rounded-lg p-3">
      <div class="profile_comment flex justify-between gap-3">
        <div class="left_profile flex gap-3">
          <div
            class="profile_comment_img rounded-md w-[60px] h-[60px] bg-cover bg-center overflow-hidden">
            <img
              src="../../assets/card_img/card_1.jpg"
              alt="Profile Comment"
              class="w-full h-full object-cover" />
          </div>
          <div class="flex flex-col gap-2">
            <p class="text-slate-700 font-semibold text-[16px]">Cassie</p>
            <div class="created_at flex gap-2 items-center">
              <i class="fa-regular fa-calendar text-slate-500"></i>
              <p class="text-slate-500 text-[16px]">July 14, 2024</p>
            </div>
          </div>
        </div>
        <div
          id="btn_reply"
          class="right_profile flex gap-2 items-center bg-slate-200 rounded-lg px-3 py-1">
          <i class="fa-solid fa-reply text-slate-500"></i>
          <p class="text-slate-500 text-[16px]">reply</p>
        </div>
      </div>
      <p class="text-slate-700 text-[16px]">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
        quos.
      </p>
    </div>
    <div class="comment_card space-y-3 mt-5 bg-slate-100 rounded-lg p-3">
      <div class="profile_comment flex justify-between gap-3">
        <div class="left_profile flex gap-3">
          <div
            class="profile_comment_img rounded-md w-[60px] h-[60px] bg-cover bg-center overflow-hidden">
            <img
              src="../../assets/card_img/card_3.jpg"
              alt="Profile Comment"
              class="w-full h-full object-cover" />
          </div>
          <div class="flex flex-col gap-2">
            <p class="text-slate-700 font-semibold text-[16px]">Cassie</p>
            <div class="created_at flex gap-2 items-center">
              <i class="fa-regular fa-calendar text-slate-500"></i>
              <p class="text-slate-500 text-[16px]">July 14, 2024</p>
            </div>
          </div>
        </div>
        <div
          id="btn_reply"
          class="right_profile flex gap-2 items-center bg-slate-200 rounded-lg px-3 py-1">
          <i class="fa-solid fa-reply text-slate-500"></i>
          <p class="text-slate-500 text-[16px]">reply</p>
        </div>
      </div>
      <p class="text-slate-700 text-[16px]">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam,
        quos.
      </p>
    </div>
  </div>

  <div class="comment_form mt-7 space-y-3">
    <p class="font-semibold text-slate-700 text-2xl">Leave a Comment</p>
    <form action="" class="flex flex-col gap-3">
      <textarea
        name=""
        id=""
        class="textarea textarea-bordered w-full bg-slate-100"
        cols="30"
        rows="10"
        placeholder="Write your comment here..."></textarea>
    </form>
    <div class="md:flex md:items-start justify-between gap-5">
      <div class="rate bg-slate-100 rounded-lg p-3 w-full lg:w-2/3">
        <div class="flex flex-col lg:flex-row justify-between items-center">
          <p class="font-semibold self-start lg:self-center text-slate-700 text-lg md:text-xl">
            Rate this post
          </p>
          <div class="rate_container self-start lg:self-center flex justify-between items-center gap-3">
            <button
              class="rating-btn flex items-center space-x-2 text-[#FC5C65] rounded-lg px-3 py-2 transition-all"
              data-rating="Bad"
              data-color="bg-[#FC5C65]">
              <i class="fa-regular fa-face-angry text-2xl"></i>
              <span class="rating-label hidden">Bad</span>
            </button>
            <button
              class="rating-btn flex items-center space-x-2 text-[#FA8231] rounded-lg px-3 py-2 transition-all"
              data-rating="Not Good"
              data-color="bg-[#FA8231]">
              <i class="fa-regular fa-face-meh text-2xl"></i>
              <span class="rating-label hidden">Meh</span>
            </button>
            <button
              class="rating-btn flex items-center space-x-2 text-[#F7B731] rounded-lg px-3 py-2 transition-all"
              data-rating="Neutral"
              data-color="bg-[#F7B731]">
              <i class="fa-regular fa-face-laugh text-2xl"></i>
              <span class="rating-label hidden">Neutral</span>
            </button>
            <button
              class="rating-btn flex items-center space-x-2 text-[#45AAF2] rounded-lg px-3 py-2 transition-all"
              data-rating="Good"
              data-color="bg-[#45AAF2]">
              <i class="fa-regular fa-face-grin-hearts text-2xl"></i>
              <span class="rating-label hidden">Good</span>
            </button>
            <button
              class="rating-btn flex items-center space-x-2 text-[#26DE81] rounded-lg px-3 py-2 transition-all"
              data-rating="Excellent"
              data-color="bg-[#26DE81]">
              <i class="fa-regular fa-face-grin-stars text-2xl"></i>
              <span class="rating-label hidden">Excellent</span>
            </button>
          </div>
        </div>
      </div>
      <button
        id="btn_submit"
        class="bg-[#F81539]/75 text-white rounded-lg px-3 py-4 gap-2 items-center justify-center md:w-1/3 hidden lg:flex">
        <i class="fa-solid fa-comment-dots text-base"></i>
        <p class="text-[14px]">Send Comment</p>
      </button>
    </div>
  </div>

  <div class="flex justify-end mt-5 lg:hidden">
    <button
      id="btn_submit"
      class="bg-[#F81539]/75 text-white rounded-lg px-3 py-4 flex gap-2 items-center justify-center">
      <i class="fa-solid fa-comment-dots text-base"></i>
      <p class="text-base">Send Comment</p>
    </button>
  </div>
</section>

<section class="popular mt-8 lg:mt-12 px-5 lg:px-8 space-y-3">
  <p class="font-semibold text-slate-700 text-2xl">Recomendation Post</p>
  <div class="carrousel_post flex pb-6 overflow-hidden">
    <?php foreach ($random_post as $post) : ?>
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
</section>

<script>
  const ratingButtons = document.querySelectorAll(".rating-btn");

  ratingButtons.forEach((button) => {
    const ratingLabel = button.querySelector(".rating-label");

    button.addEventListener("click", () => {
      ratingButtons.forEach((btn) => {
        const label = btn.querySelector(".rating-label");
        const colorClass = btn.getAttribute("data-color");

        btn.classList.remove(colorClass, "text-white");
        btn.classList.remove("px-6", "py-3");

        label.classList.add("hidden");
      });
      const bgColorClass = button.getAttribute("data-color");
      ratingLabel.classList.remove("hidden");
      button.classList.add(bgColorClass, "text-white", "px-6", "py-3");
      button.classList.remove("text-gray-700", "border");
    });
  });

  $(document).ready(function() {
    $(".carrousel_post").slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            autoplay: false,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 4000,
          },
        },
      ],
    });
  });

  const profileAuthor = document.querySelectorAll(".profile_author_img");

  profileAuthor.forEach((author) => {
    author.addEventListener("click", () => {
      window.location.href = "?pg=about-author&user_id=<?= base64_encode($user['id_user']) ?>";
    });
  });
</script>