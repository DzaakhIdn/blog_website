<!-- Navbar -->
<?php
if (isset($_SESSION["id_user"])) {
  $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'"));

  $username = $user['username'];
  $email = $user['email'];
  $no_telp = $user['phone'];
  $alamat = $user['address'];
  $bio = $user['bio'];
  $profile = $user['avatar'];
  $gender = $user['gender'];
}
?>
<nav id="" class="nav_lg">
  <div class="nav hidden lg:flex lg:items-center">
    <a href="index.php" class="title text-2xl font-extrabold">Blog.my</a>
    <ul class="menu menu-horizontal px-1">
      <li>
        <a href="?pg=category">Category</a>
      </li>
      <li><a href="?pg=contact-us">Contact Us</a></li>
      <li><a href="?pg=about">About Us</a></li>
    </ul>
  </div>
  <div class="top_mobile_container">
    <div class="menu_container flex md:justify-between md:w-full">
      <div
        for="drawer-left"
        class="btn menu_mobile"
        aria-haspopup="dialog"
        aria-expanded="false"
        aria-controls="hs-offcanvas-example"
        data-hs-overlay="#hs-offcanvas-example">
        <i class="ph-bold ph-list text-xl"></i>
      </div>
      <div class="menu_tab hidden md:flex md:gap-2">
        <div
          class="search_lg">
          <!-- More Options Icon -->
          <i class="ph-bold ph-dots-three-vertical"></i>

          <!-- Search Input -->
          <input
            type="text"
            placeholder="Search Anything"
            class="bg-transparent focus:outline-none text-gray-700 placeholder-gray-800 flex-grow w-full" />

          <!-- Search Icon -->
          <i class="ph-bold ph-magnifying-glass"></i>
        </div>
        <div class="avatar flex items-center gap-1">
          <?php if (isset($_SESSION['id_user'])) : ?>
            <div class="dropdown dropdown-end">
              <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar" onclick="window.location.href = './Admin'">
                <div class="w-12 h-12 rounded-md overflow-hidden shadow-md">
                  <img
                    alt="User Avatar"
                    src="./public/img/profile/<?= $profile ?>"
                    class="object-cover w-full h-full" />
                </div>
              </div>
            </div>
            <div
              onclick="window.location.href = './Admin/views/index.php?pg=posts'"
              class="btn bg-orange-500 text-white px-3 py-2 rounded-lg shadow-md flex items-center justify-center cursor-pointer hover:bg-orange-600 transition-all lg:tooltip" data-tip="add post">
              <i class="ph-bold ph-plus text-lg"></i>
            </div>
          <?php else : ?>
            <a
              href="./Admin"
              class="btn bg-orange-400 text-white px-5 py-2 rounded-lg shadow-md hover:bg-orange-500 transition-all">
              Join
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div
      class="flex items-center justify-between px-4 py-2 bg-gray-300 rounded-md w-full lg:hidden">
      <!-- More Options Icon -->
      <i class="ph-bold ph-dots-three-vertical"></i>

      <!-- Search Input -->
      <input
        type="text"
        placeholder="Search Anything"
        class="bg-transparent focus:outline-none text-gray-700 placeholder-gray-800 flex-grow w-full" />

      <!-- Search Icon -->
      <i class="ph-bold ph-magnifying-glass"></i>
    </div>
  </div>
  <!-- Sidebar -->
  <div
    id="hs-offcanvas-example"
    class="hs-overlay hs-overlay-open:translate-x-0 hidden -translate-x-full fixed top-0 start-0 transition-all duration-300 transform h-full max-w-xs w-full z-[80] bg-white border-e dark:bg-neutral-800 dark:border-neutral-700"
    role="dialog"
    tabindex="-1"
    aria-labelledby="hs-offcanvas-example-label">
    <div
      class="flex justify-between items-center py-3 px-4 dark:border-neutral-700">
      <a
        href="/"
        id="hs-offcanvas-example-label"
        class="font-bold text-gray-800 dark:text-white">
        Blog.my
      </a>
      <button
        type="button"
        class="size-10 inline-flex justify-center items-center gap-x-2 rounded-md border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
        aria-label="Close"
        data-hs-overlay="#hs-offcanvas-example">
        <i class="ph-bold ph-x"></i>
      </button>
    </div>
    <ul class="hs-accordion-group ps-3 pt-2" data-hs-accordion-always-open>
      <li class="hs-accordion" id="account-accordion">
        <button
          type="button"
          class="btn_option hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent dark:hs-accordion-active:text-white"
          aria-expanded="true"
          aria-controls="account-accordion">
          Categories
          <svg
            class="hs-accordion-active:block ms-auto hidden size-4 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="m18 15-6-6-6 6" />
          </svg>

          <svg
            class="hs-accordion-active:hidden ms-auto block size-4 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg>
        </button>

        <div
          id="account-accordion"
          class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
          role="region"
          aria-labelledby="account-accordion">
          <ul class="pt-2 ps-2">
            <li>
              <a
                class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                href="#">
                Link 1
              </a>
            </li>
            <li>
              <a
                class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                href="#">
                Link 2
              </a>
            </li>
            <li>
              <a
                class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                href="#">
                Link 3
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="hs-accordion" id="account-accordion">
        <button
          type="button"
          class="btn_option hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent dark:hs-accordion-active:text-white"
          aria-expanded="true"
          aria-controls="account-accordion">
          Pages
          <svg
            class="hs-accordion-active:block ms-auto hidden size-4 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="m18 15-6-6-6 6" />
          </svg>

          <svg
            class="hs-accordion-active:hidden ms-auto block size-4 text-gray-600 group-hover:text-gray-500 dark:text-neutral-400"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
          </svg>
        </button>

        <div
          id="account-accordion"
          class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
          role="region"
          aria-labelledby="account-accordion">
          <ul class="pt-2 ps-2">
            <li>
              <a
                class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                href="#">
                Link 1
              </a>
            </li>
            <li>
              <a
                class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                href="#">
                Link 2
              </a>
            </li>
            <li>
              <a
                class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                href="#">
                Link 3
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li><a class="sb_option" href="/src/pages/contact-us.html"> Contact Us </a></li>
      <li><a class="sb_option" href="/src/pages/about-us.html"> About Us </a></li>
    </ul>
  </div>
</nav>