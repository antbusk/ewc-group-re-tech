<?php
include_once('db.php');
$db = new DB();
$db->videosUpdateOrder($_POST['video']);
?>