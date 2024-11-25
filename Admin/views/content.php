<?php
if(!isset($_GET['pg'])){
    $pg = '';
}
$sesi = isset($_SESSION['user']) ? $_SESSION['user'] : '';
if ($pg == '') {
    $current_page = basename($_SERVER['PHP_SELF']);
    if ($current_page == 'index.php') {
        include('home.php');
    } elseif ($current_page == 'auth-page.php') {
        include('./../services/signin.php');
    }
}elseif($pg == 'signup'){
    include('./../services/signup.php');
}
elseif($pg == 'category'){
    if(!isset($_GET['id'])){
        include('./../services/add_category.php');
    }else{
        include('./../services/edit_category.php');
    }
}elseif($pg == 'tags'){
    if(!isset($_GET['id'])){
        include('./../services/add_tags.php');
    }else{
        include('./../services/edit_tags.php');
    }
}elseif($pg == 'profile'){
    include('./../services/setting.php');
}else{
    include('./../404.html');
}