<?php

$username="root";
$password="window16";
$database="re_tech";

$connection = mysql_connect(':/cloudsql/ewc-group-re-tech:db',
  'root', // username
  ''      // password
  );
if (!$connection) {
  die('Not connected : ' . mysql_error());
}


// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

?>