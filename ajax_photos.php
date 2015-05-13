<?php
require("db_info.php");
$prod_unid = $_GET['unid'];
$user_unid = $_GET['user'];
	$query1 = "SELECT * FROM photos WHERE prod_unid = '$prod_unid' ORDER BY `order` ASC";
	$result = mysql_query($query1);
if (!$result) {
  die('Invalid query: ' . mysql_error());
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Drag&amp;Drop Reorder</title>
<link href="http://storage.googleapis.com/ewc-group-re-tech.appspot.com/js/style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://storage.googleapis.com/ewc-group-re-tech.appspot.com/js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
//	$('.reorder_link').on('click',function(){
	setTimeout(function(){
		
		$("ul.reorder-photos-list").sortable({ 
		tolerance: 'pointer',
		stop: function (event, ui) {

	        var data23 = $(this).sortable('serialize');		
			$("#ids").html(data23);
		        $.ajax({
            data: data23,
            type: 'POST',
            url: 'photos_update_order.php'
        });
		
		}
		
		});
		
		
		$('.reorder_link').html('save reordering');
		$('.reorder_link').attr("id","save_reorder");
		$('#reorder-helper').slideDown('slow');
		$('.image_link').attr("href","javascript:void(0);");
		$('.image_link').css("cursor","move");
}, 2000);
//	});
	
});
</script>
</head>

<body>




<div id='ids'> </div>
<div>

    <div class="gallery">
	
        <ul class="reorder_ul reorder-photos-list">
 
		<?php while ($row = @mysql_fetch_assoc($result)){
			//Fetch all images from database
 ?>
            <li id="image_<?php echo $row['unid']; ?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link"><img src="photo_url.php?size=200&unid=<?php echo $row['unid']; ?>" alt=""></a>
			<p><button class="btn btn-large" type="button" onClick="delete_pic('<?php echo $row['unid']; ?>', '<?php echo $row['prod_unid']; ?>')" name="submit" value="submit">Delete</button></p>
			</li>
        <?php } ?>
        </ul>
    </div>
</div>
</body>
</html>


<script>

function delete_pic(pic, prod_unid){
	$.get("delete_photo.php?user=<?php echo $user_unid; ?>&unid=" + pic + "&prod_unid=" + prod_unid);
}
</script>