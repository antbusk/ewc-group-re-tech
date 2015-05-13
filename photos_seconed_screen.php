<?php
require('login_check.php');
echo $header;

?>
<script>
				        pubnub.subscribe({
						channel: "pic_done_<?php echo $user_unid; ?>",
						message: function(m) {
						if (m.state == "load"){	
						product_unid = m.prod_unid;
						$.get("ajax_photos.php?user=<?php echo $user_unid; ?>&unid=" + product_unid, function(data2) {
						$("#photos").html(data2);
						});
						}
						}});	
						</script>

<div class="row">
<div id="photos" class="col-sm-12">
</div>
</div>
<?php	

echo $footer;
?>