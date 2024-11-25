<?php
require_once __DIR__ . '/../Classes/init.php';
require_once __DIR__ . '/../DB/connections.php';

$id = $_GET['id'];
$tag = new Tag();
$result = $tag->delete($id);
?>

