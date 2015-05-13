<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
require("db_info.php");
$prod_unid = $_GET['unid'];
$user_unid = $_GET['user'];
	$query1 = "SELECT * FROM videos WHERE prod_unid = '$prod_unid' ORDER BY `order` ASC";
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
		
		$("ul.reorder-videos-list").sortable({ 
		tolerance: 'pointer',
		stop: function (event, ui) {

	        var dataVideo = $(this).sortable('serialize');		
			$("#ids").html(dataVideo);
		        $.ajax({
            data: dataVideo,
            type: 'POST',
            url: 'videos_update_order.php'
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
	
        <ul class="reorder_ul reorder-videos-list">
 
		<?php while ($row = @mysql_fetch_assoc($result)){
			//Fetch all images from database
$object_video_file = 'gs://ewc-group-re-tech.appspot.com/videos/' . $row['unid'] . '.mp4';
$object_video_url = CloudStorageTools::getPublicUrl($object_video_file, false);
 ?>
            <li id="video_<?php echo $row['unid']; ?>" class="ui-sortable-handle"><a href="javascript:void(0);" style="float:none;" class="image_link">
			<div id="mediaplayer_<?php echo $row['unid']; ?>"></div>
			<script>

				jwplayer("mediaplayer_<?php echo $row['unid']; ?>").setup({
					width:320,
					height:240,
					file: '<?php echo $object_video_url; ?>',
				
				});
			
			</script>
	
			
			
			
			</a>
			<p><button class="btn btn-large" type="button" onClick="delete_vid('<?php echo $row['unid']; ?>', '<?php echo $row['prod_unid']; ?>')" name="submit" value="submit">Delete</button></p>
			</li>
        <?php } ?>
        </ul>
    </div>
</div>
</body>
</html>


<script>

function delete_vid(vid, prod_unid){
	$.get("delete_video.php?user=<?php echo $user_unid; ?>&unid=" + vid + "&prod_unid=" + prod_unid);
}
</script>