<?php
$pg = $_GET['pg'] ?? '';

switch ($pg) {
    case '':
        include('./src/pages/home.php');
        break;
    case 'category' :
        include('./src/pages/categories.php');
        break;
    case 'post' :
        include('./src/pages/single_blog.php');
}