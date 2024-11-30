// src/js/component/navbar.js

export function renderNavigation(selector) {
    const container = document.querySelector(selector);
    if (!container) return;

    container.innerHTML = `
      <div
        class="flex items-center justify-between gap-6 w-full bg-white px-3 py-4 rounded-tr-lg rounded-tl-lg shadow-md border"
      >
        <!-- Home Button -->
        <button
          class="nav-button flex items-center gap-2 text-gray-500 selected"
          data-label="Home"
        >
        <i class="ph ph-house text-lg"></i>
          <span>Home</span>
        </button>

        <!-- Bookmark Button -->
        <button
          class="nav-button flex items-center text-gray-500"
          data-label="Save"
        >
        <i class="ph ph-bookmark-simple text-lg"></i>
          <span class="ml-2 hidden">Save</span>
        </button>

        <!-- User Button -->
        <button
          class="nav-button flex items-center text-gray-500"
          data-label="Profile"
        >
        <i class="ph-fill ph-user"></i>
          <span class="ml-2 hidden">Profile</span>
        </button>

        <!-- More Button -->
        <button
          class="nav-button flex items-center text-gray-500"
          data-label="More"
        >
        <i class="ph ph-caret-double-up"></i>
          <span class="ml-2 hidden">More</span>
        </button>
      </div>
    `;

    // Menambahkan logika pemilihan untuk setiap tombol
    document.addEventListener("DOMContentLoaded", () => {
        const buttons = document.querySelectorAll(".nav-button");

        buttons.forEach((button) => {
            button.addEventListener("click", () => {
              const label = button.getAttribute("data-label");
              switch(label){
                case "Home":
                  window.location.href = "/";
                  button.classList.add("selected");
                  button.querySelector("span").classList.remove("hidden");
                  break;
                case "Save":
                  window.location.href = "/src/pages/bookmark.html";
                  button.classList.add("selected");
                  button.querySelector("span").classList.remove("hidden");
                  break;
                case "Profile":
                  window.location.href = "/src/pages/profile.html";
                  button.classList.add("selected");
                  button.querySelector("span").classList.remove("hidden");
                  break;
                case "More":
                  window.location.href = "/src/pages/more.html";
                  button.classList.add("selected");
                  button.querySelector("span").classList.remove("hidden");
                  break;
              }
            });
        });
        
        const grayScalePages = [
            "/src/pages/about-us.html",
            "/src/pages/single_blog.html",
            "/src/pages/about_author.html"
        ];
        

        console.log("Is grayscale page:", grayScalePages.includes(window.location.pathname));
        
        if(grayScalePages.includes(window.location.pathname)){
            buttons.forEach((btn) => {
                btn.classList.add("grayscale");
                btn.classList.add("opacity-50");
            });
        }
    });
}


export function renderNavbar(selector){
  const container = document.querySelector(selector)
  if(!container) return;

  container.innerHTML = `
  <!-- lg navbar -->
    <div class="nav hidden lg:flex lg:items-center">
      <a href="/" class="title text-2xl font-extrabold">Blog.my</a>
      <ul class="menu menu-horizontal px-1">
        <li>
          <a href="/src/pages/categories.html">Category</a>
        </li>
        <li>
          <details>
            <summary>Pages</summary>
            <ul class="bg-base-100 rounded-t-none p-2">
              <li><a>Link 1</a></li>
              <li><a>Link 2</a></li>
            </ul>
          </details>
        </li>
        <li><a href="/src/pages/contact-us.html">Contact Us</a></li>
        <li><a href="/src/pages/about-us.html">About Us</a></li>
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
          data-hs-overlay="#hs-offcanvas-example"
        >
          <i class="ph-bold ph-list text-xl"></i>
        </div>
        <div class="menu_tab hidden md:flex md:gap-2">
          <div
            class="search_lg"
          >
            <!-- More Options Icon -->
            <i class="ph-bold ph-dots-three-vertical"></i>

            <!-- Search Input -->
            <input
              type="text"
              placeholder="Search Anything"
              class="bg-transparent focus:outline-none text-gray-700 placeholder-gray-800 flex-grow w-full"
            />

            <!-- Search Icon -->
            <i class="ph-bold ph-magnifying-glass"></i>
          </div>
          <div class="avatar">
            <div class="w-[48px] rounded">
              <img
                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp"
                alt="Tailwind-CSS-Avatar-component"
              />
            </div>
          </div>
          <div class="btn icon_bookmark">
            <i class="ph-bold ph-bookmark-simple text-xl"></i>
          </div>
        </div>
      </div>
      <div
        class="flex items-center justify-between px-4 py-2 bg-gray-300 rounded-md w-full lg:hidden"
      >
        <!-- More Options Icon -->
        <i class="ph-bold ph-dots-three-vertical"></i>

        <!-- Search Input -->
        <input
          type="text"
          placeholder="Search Anything"
          class="bg-transparent focus:outline-none text-gray-700 placeholder-gray-800 flex-grow w-full"
        />

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
      aria-labelledby="hs-offcanvas-example-label"
    >
      <div
        class="flex justify-between items-center py-3 px-4 dark:border-neutral-700"
      >
        <a
          href="/"
          id="hs-offcanvas-example-label"
          class="font-bold text-gray-800 dark:text-white"
        >
          Blog.my
        </a>
        <button
          type="button"
          class="size-10 inline-flex justify-center items-center gap-x-2 rounded-md border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
          aria-label="Close"
          data-hs-overlay="#hs-offcanvas-example"
        >
          <i class="ph-bold ph-x"></i>
        </button>
      </div>
      <ul class="hs-accordion-group ps-3 pt-2" data-hs-accordion-always-open>
        <li class="hs-accordion" id="account-accordion">
          <button
            type="button"
            class="btn_option hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent dark:hs-accordion-active:text-white"
            aria-expanded="true"
            aria-controls="account-accordion"
          >
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
              stroke-linejoin="round"
            >
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
              stroke-linejoin="round"
            >
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>

          <div
            id="account-accordion"
            class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
            role="region"
            aria-labelledby="account-accordion"
          >
            <ul class="pt-2 ps-2">
              <li>
                <a
                  class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                  href="#"
                >
                  Link 1
                </a>
              </li>
              <li>
                <a
                  class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                  href="#"
                >
                  Link 2
                </a>
              </li>
              <li>
                <a
                  class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                  href="#"
                >
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
            aria-controls="account-accordion"
          >
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
              stroke-linejoin="round"
            >
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
              stroke-linejoin="round"
            >
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>

          <div
            id="account-accordion"
            class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
            role="region"
            aria-labelledby="account-accordion"
          >
            <ul class="pt-2 ps-2">
              <li>
                <a
                  class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                  href="#"
                >
                  Link 1
                </a>
              </li>
              <li>
                <a
                  class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                  href="#"
                >
                  Link 2
                </a>
              </li>
              <li>
                <a
                  class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-700 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:text-neutral-400 dark:hover:text-neutral-300 dark:focus:text-neutral-300"
                  href="#"
                >
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
  `
}

export function renderFooter(selector) {
  const container = document.querySelector(selector);
  if (!container) return;

  container.innerHTML = `
    <div class="md:flex w-full hidden">
        <div
          class="left_footer flex-1 px-10 py-5 rounded-tr-xl rounded-br-xl bg-slate-200"
        >
          <!-- Info Footer -->
          <div class="info_footer flex justify-between mb-5">
            <!-- News Section -->
            <div class="news w-1/2 space-y-5">
              <!-- Mega News -->
              <div class="mega_news space-y-2">
                <p
                  class="title_footer font-semibold text-[20px] "
                  style="font-family: 'Montserrat Alternates'"
                >
                  Mega news
                </p>
                <p class="text-slate-500 text-[14px]">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit...
                  <!-- truncated for brevity -->
                </p>
              </div>

              <!-- Newsletter -->
              <div class="news_letters space-y-2">
                <p
                  class="title_footer font-semibold text-[20px] "
                  style="font-family: 'Montserrat Alternates'"
                >
                  Newsletters
                </p>
                <label class="input input-bordered flex items-center gap-2">
                  <input type="text" class="grow" placeholder="Email" />
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="h-4 w-4 opacity-70"
                  >
                    <!-- SVG paths -->
                  </svg>
                </label>
              </div>
            </div>

            <!-- Social Media & Categories -->
            <div class="sosmed_footer space-y-5">
              <!-- Categories -->
              <div class="categories space-y-3">
                <p
                  class="title_footer font-semibold text-[20px] "
                  style="font-family: 'Montserrat Alternates'"
                >
                  Categories
                </p>
                <ul class="text-slate-500 text-[14px] space-y-2">
                  <li><a href="#">Gaming</a></li>
                  <li><a href="#">Dunia Coding</a></li>
                  <li><a href="#">Technology</a></li>
                  <li><a href="#">Traveling</a></li>
                </ul>
              </div>

              <!-- Social Media Icons -->
              <div class="sosmed_footer flex gap-2">
                <div
                  class="sosmed_icon bg-gradient-to-r from-[#F45C9F] to-[#FF7563] p-2 rounded-md flex items-center gap-2"
                >
                  <i class="fa-brands fa-instagram text-white"></i>
                  <p class="text-white text-[14px]">Instagram</p>
                </div>
                <div
                  class="sosmed_icon w-10 h-10 grid place-items-center rounded-lg bg-gradient-to-r from-[#2CA5E0] to-[#67C9F5]"
                >
                  <i class="fa-brands fa-twitter text-white"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Copyright Section -->
          <div
            class="copyright flex justify-between py-4 px-3 rounded-tr-xl rounded-br-xl bg-slate-300"
          >
            <div class="privacy_policy flex gap-2 divide-x divide-slate-500">
              <p class="text-slate-500 text-[14px] pr-2">Privacy Policy</p>
              <p class="text-slate-500 text-[14px] px-2">Terms of Service</p>
            </div>
            <p class="text-slate-500 text-[14px] font-light">
              Copyright © 2024 <span class="font-bold">Mega News</span>. All
              rights reserved.
            </p>
          </div>
        </div>

        <!-- Right Footer Section -->
        <div class="right_footer hidden lg:flex gap-8 pl-8 pr-7">
          <!-- Comments Section -->
          <div class="comments_section w-[300px]">
            <p
              class="title_footer font-semibold text-[20px] mb-4 "
              style="font-family: 'Montserrat Alternates'"
            >
              Comments
            </p>
            <div class="comment_container flex flex-col gap-4">
              <!-- Comment items -->
              <div class="comment py-4 px-3 rounded-lg bg-slate-200">
                <p class="text-slate-700 font-bold text-[16px]">Cassie</p>
                <p class="text-slate-500 text-[14px]">
                  Lorem ipsum dolor sit amet 🥰
                </p>
              </div>
              <!-- Additional comments... -->
            </div>
          </div>

          <!-- Instagram Feed Section -->
          <div class="sosmed_user w-[320px]">
            <p
              class="title_footer font-semibold text-[20px] mb-4 "
              style="font-family: 'Montserrat Alternates'"
            >
              Follow on <br />
              Instagram
            </p>
            <div class="sosmed_user_container grid grid-cols-3 gap-2">
              <!-- Instagram feed items -->
              <div
                class="sosmed_user_card rounded-md w-20 h-20 overflow-hidden"
              >
                <img
                  src="../../assets/card_img/card_1.jpg"
                  alt="Social media post"
                  class="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
}

