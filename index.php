<?php
require_once('./Admin/DB/connections.php');
require_once('./Admin/Classes/init.php');

$post = new Post();
$posts = $post->filter_data(null, 'views', 'DESC');
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Main Page</title>
  <!-- CSS -->
  <link rel="stylesheet" href="src/css/output.css" />
  <link rel="stylesheet" href="./assets/slick/slick.css" type="text/css" />
  <link
    rel="stylesheet"
    href="./assets/slick/slick-theme.css"
    type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./src/css/custom_css/styles.css" />
  <!-- Icon -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
</head>

<body>
  <?php include('./src/componenet/navbar_lg.php') ?>

  <?php include('./src/pages/content.php') ?>

  <!-- Mobile Navigation -->
  <?php include('./src/componenet/navigation.php'); ?>
  <!-- Tab and Large Footer -->
  <footer id="lg_footer" class="lg_footer py-5 my-5 w-full">
    <?php include('./src/componenet/footer.php'); ?>
  </footer>

  <!-- ModuleScripts -->
  <script src="./node_modules/preline/dist/preline.js"></script>
  <script src="./src/js/jquery-3.7.1.min.js"></script>
  <script src="./assets/slick/slick.js"></script>
  <!-- Main Javascript -->
  <script src="./src/js/custom/main.js"></script>
  <!-- Script -->
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
      const buttons = document.querySelectorAll(".nav-button");

      buttons.forEach((button) => {
        button.addEventListener("click", () => {
          const label = button.getAttribute("data-label");
          switch (label) {
            case "Home":
              window.location.href = "/";
              button.classList.add("selected");
              button.querySelector("span").classList.remove("hidden");
              break;
            case "Save":
              window.location.href = "./src/pages/bookmark.html";
              button.classList.add("selected");
              button.querySelector("span").classList.remove("hidden");
              break;
            case "Profile":
              window.location.href = "./src/pages/profile.html";
              button.classList.add("selected");
              button.querySelector("span").classList.remove("hidden");
              break;
            case "More":
              window.location.href = "./src/pages/more.html";
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

      if (grayScalePages.includes(window.location.pathname)) {
        buttons.forEach((btn) => {
          btn.classList.add("grayscale");
          btn.classList.add("opacity-50");
        });
      }
    });
  </script>
</body>

</html>