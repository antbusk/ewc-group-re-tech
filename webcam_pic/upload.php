<?php
require("../db_info.php");
$pic_var = $_FILES;
$prod_unid = $_GET['unid'];
$query = "INSERT INTO photos (prod_unid) VALUES ('$prod_unid')";
	$result1 = mysql_query($query);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
$pic_name = mysql_insert_id();
$gs_name = $_FILES[0]['tmp_name'];
move_uploaded_file($gs_name, 'gs://ewc-group-re-tech.appspot.com/photos/' . $pic_name . '.jpg');



?>