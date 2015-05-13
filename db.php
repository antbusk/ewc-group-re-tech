<?php
class DB{
	function __construct(){
		
		
		
		
		      $this->connection = mysql_connect(':/cloudsql/ewc-group-re-tech:db', 'root', '') or die(mysql_error());
				mysql_select_db('re_tech', $this->connection) or die(mysql_error());
		
		
		
		
		
		
		
		
		

	}
	
	function getRows(){
		$query = mysql_query($this->connect,"SELECT * FROM `photos` ORDER BY `order` ASC") or die(mysql_error());
		while($row = mysql_fetch_assoc($query))
		{
			$rows[] = $row;
		}
		return $rows;
	}
	
	function photosUpdateOrder($id_array){
		$count = 1;
		foreach ($id_array as $id){
			$query = "UPDATE `photos` SET `order` = '$count' WHERE unid = '$id'";
			$result = mysql_query($query, $this->connection);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
			$count ++;	
		}
		return true;
	}
	
	
	
		function videosUpdateOrder($id_array){
		$count = 1;
		foreach ($id_array as $id){
			$query = "UPDATE `videos` SET `order` = '$count' WHERE unid = '$id'";
			$result = mysql_query($query, $this->connection);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
			$count ++;	
		}
		return true;
	}
	
	
}
?>