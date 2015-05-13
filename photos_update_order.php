<?php
include_once('db.php');
$db = new DB();
$db->photosUpdateOrder($_POST['image']);
?>