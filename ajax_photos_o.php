<?php
require("db_info.php");
$prod_unid = $_GET['unid'];
$user_unid = $_GET['user'];
	$query1 = "SELECT * FROM photos WHERE prod_unid = '$prod_unid'";
	$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done
	$query2 = "SELECT * FROM photos WHERE prod_unid = '$prod_unid'";
	$result2 = mysql_query($query2);
if (!$result2) {
  die('Invalid query: ' . mysql_error());
	}
// done
$num_pics_left = mysql_num_rows($result1);
?>
<script>
function delete_pic(pic, prod_unid){
	$.get("delete_photo.php?user=<?php echo $user_unid; ?>&unid=" + pic + "&prod_unid=" + prod_unid);
}
</script>
<div class="row" >
<?php
$counter1 = 0;
$counter2 = 0;
while ($row = @mysql_fetch_assoc($result2)){ 
$counter1++;
$counter2++;
?>
<div class="col-md-2"><img src="photo_url.php?size=200&unid=<?php echo $row['unid']; ?>">
<p><button class="btn btn-large" type="button" onClick="delete_pic('<?php echo $row['unid']; ?>', '<?php echo $row['prod_unid']; ?>')" name="submit" value="submit">Delete</button></p>
</div>

<?php
if($counter1 % 6 == 0) {
?>
</div>
<div class="row" >
<?php
}
if($num_pics_left == 1 ){
$num1 = 6;
$blanks = $num1 - $counter2;
while ($blanks > 0) {
$blanks--;
?>
<div class="col-md-2"></div>
<?php
}
}
if ($counter2 == 6){
	$counter2 = 1;
}
$num_pics_left--;;


}
?>
</div>

