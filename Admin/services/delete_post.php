<?php
require_once __DIR__ . '/../Classes/init.php';
require_once __DIR__ . '/../DB/connections.php';

$user = "SELECT * FROM users WHERE id_user = '$_SESSION[id_user]'";
$result = mysqli_query($conn, $user);
$row = mysqli_fetch_assoc($result);

$id = $_GET['id'];
$post = new Post();
$result = $post->delete($id);