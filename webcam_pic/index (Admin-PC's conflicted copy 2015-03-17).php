<?php
if(isset($_GET['unid'])){
$prod_unid = mysql_real_escape_string($_GET['unid']);
}
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;

$options = [ 'gs_bucket_name' => 'gs://ewc-group-re-tech.appspot.com/photos/' ];
$upload_url = CloudStorageTools::createUploadUrl('/webcam_pic/upload.php?unid=' . $prod_unid, $options);

?>


<script type="text/javascript" src="static/webcam.js"></script>
<script language="JavaScript">
		document.write( webcam.get_html(320, 240) );
</script>
<form>
		<input type=button value="Configure..." onClick="webcam.configure()">
		&nbsp;&nbsp;
		<input type=button value="Take Snapshot" onClick="take_snapshot()">
	</form>

<script language="JavaScript">
		function take_snapshot(){
			// take snapshot and upload to server
			document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
			webcam.snap();
		}
		
		    webcam.set_api_url( '<?php echo $upload_url; ?>' );
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		webcam.set_swf_url( 'static/webcam.swf' );
		webcam.set_shutter_url( 'static/shutter.mp3' );
		
		
		document.write( webcam.get_html(320, 240) );
</script>

<script language="JavaScript">

		


		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				// show JPEG image in page
				document.getElementById('upload_results').innerHTML ='<h1>Upload Successful!</h1>';
				// reset camera for another shot
				webcam.reset();
			}
			else {alert("PHP Error: " + msg);
		}
	</script>
<div id="upload_results" style="background-color:#eee;"></div>