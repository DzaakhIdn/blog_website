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
                // Remove selected class and hide text for all buttons
                buttons.forEach((btn) => {
                    btn.classList.remove("selected");
                    btn.querySelector("span").classList.add("hidden");
                });

                // Add selected class and show text for the clicked button
                button.classList.add("selected");
                button.querySelector("span").classList.remove("hidden");
            });
        });
    });
}

