<div class="md:flex w-full hidden">
    <div
        class="left_footer flex-1 px-10 py-5 rounded-tr-xl rounded-br-xl bg-slate-200">
        <!-- Info Footer -->
        <div class="info_footer flex justify-between mb-5">
            <!-- News Section -->
            <div class="news w-1/2 space-y-5">
                <!-- Mega News -->
                <div class="mega_news space-y-2">
                    <p
                        class="title_footer font-semibold text-[20px] "
                        style="font-family: 'Montserrat Alternates'">
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
                        style="font-family: 'Montserrat Alternates'">
                        Newsletters
                    </p>
                    <label class="input input-bordered flex items-center gap-2">
                        <input type="text" class="grow" placeholder="Email" />
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                            class="h-4 w-4 opacity-70">
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
                        style="font-family: 'Montserrat Alternates'">
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
                        class="sosmed_icon bg-gradient-to-r from-[#F45C9F] to-[#FF7563] p-2 rounded-md flex items-center gap-2">
                        <i class="fa-brands fa-instagram text-white"></i>
                        <p class="text-white text-[14px]">Instagram</p>
                    </div>
                    <div
                        class="sosmed_icon w-10 h-10 grid place-items-center rounded-lg bg-gradient-to-r from-[#2CA5E0] to-[#67C9F5]">
                        <i class="fa-brands fa-twitter text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div
            class="copyright flex justify-between py-4 px-3 rounded-tr-xl rounded-br-xl bg-slate-300">
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
                style="font-family: 'Montserrat Alternates'">
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
                style="font-family: 'Montserrat Alternates'">
                Follow on <br />
                Instagram
            </p>
            <div class="sosmed_user_container grid grid-cols-3 gap-2">
                <!-- Instagram feed items -->
                <div
                    class="sosmed_user_card rounded-md w-20 h-20 overflow-hidden">
                    <img
                        src="../../assets/card_img/card_1.jpg"
                        alt="Social media post"
                        class="w-full h-full object-cover" />
                </div>
            </div>
        </div>
    </div>
</div>