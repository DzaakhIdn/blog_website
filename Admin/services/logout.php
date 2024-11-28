<?php
require_once __DIR__ . '/../Classes/init.php';
$user = new User();

$result = $user->logout();

if ($result) {
    header("Location: ./auth-page.php");
}
exit();
