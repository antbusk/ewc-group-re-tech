<?php

require("phpsqlajax_dbinfo.php");


// Opens a connection to a MySQL server
$connection=mysql_connect ($host, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}


// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}


	
	$query = "SELECT * FROM website_catagorys_1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}





?>
 
<select name="website_catagorys">
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
  <option value="<?php echo $row['unid']; ?>"><?php echo $row['f1']; ?></option>
</select> 



<?php } ?>