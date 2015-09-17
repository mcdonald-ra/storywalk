<?php
$id=$_COOKIE['savestory'];
$page=$_GET['page'];
header('Location: story.php?id=' . $id . '&page=' . $page);
?>