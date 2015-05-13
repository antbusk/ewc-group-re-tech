<?php
$movie_record = true;
require('login_check.php');
echo $header;	
?>
        <script> 
		var code;
		$(window).bind('keypress', function(e) {

  code = (e.keyCode ? e.keyCode : e.which);

  
  if(code == 48) {
  if(page == "photobooth"){	  
new_product();
  }
  }
    if(code == 13) {
  if(page == "photobooth"){	  
closeCamera();
  }
  }

  
    if(code == 32) { 
  if(page == "photobooth"){
closeCamera();
  }
  }
  
});


						
							function startRecording() {
			$('#message').html('Recording');
				$.scriptcam.startRecording();
			}
			function closeCamera() {

				$.scriptcam.closeCamera();
				$('#message').html('Please wait for the file conversion to finish...');
			}


			function onError(errorId,errorMsg) {

				alert(errorMsg);
			}

		
		
		
		var upload_url;
		var product_unid;
		var m;
		var page  = "form";
        // wait for the DOM to be loaded 
		$(document).ready(function() {
		$("#photobooth").hide();
    // process the form
    $('form').submit(function(event) {
event.preventDefault();

		
		var prod_unid = document.getElementById("unid").value;
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'upload_url.php?user=<?php echo $user_unid; ?>&prod_unid=' + prod_unid, // the url where we want to POST
            dataType    : 'json', // what type of data do we expect back from the server
                        encode          : true
        })
            // using the done promise callback
            .done(function(data) {

                // log data to the console so we can see
                page = "photobooth";
                upload_url = data.upload_url;
				product_unid = data.unid;
				
				$("#product_form").hide();
				$("#photobooth").show();
			
			
						$.get("ajax_videos.php?user=<?php echo $user_unid; ?>&unid=" + product_unid, function(datavid1) {
						$("#videos").html('');
						$("#videos").html(datavid1);
						});
			
			
				$.get("ajax_photos.php?user=<?php echo $user_unid; ?>&unid=" + product_unid, function(data) {
				$("#photos").html(data);
				});
				
				 pubnub.publish({
     channel: 'pic_done_<?php echo $user_unid; ?>',        
     message: {
	"state":"load",
	"prod_unid":product_unid
	 }
 });

 
 
 
 				$("#webcam").scriptcam({
					path: '/ScriptCam-master/static/',
					country: 'usa',
					fileReady:fileReady,
					cornerRadius:20,
					onError:onError,
					showMicrophoneErrors:false,
					fileName:'demofilename',
					width: 640,
					height: 480,
					useMicrophone: false,
					connected:startRecording
				});
 
 			function fileReady(fileName) {

				$('#message').html('This file is now dowloadable for five minutes over <a href="'+fileName+'">here</a>.');
				var fileNameNoExtension=fileName.replace(".mp4", "");
				jwplayer("mediaplayer").setup({
					width:320,
					height:240,
					file: fileName,
					image: fileNameNoExtension+"_0000.jpg"
				});
				$('#mediaplayer').show();
										$.get('hdd_shred_video.php?user=<?php echo $user_unid; ?>&unid=' + prod_unid + '&url=' + fileName);

			}
                // here we will handle errors and validation messages
            });

			
			
			
			
			
						

				

				
				

			
			
        // stop the form from submitting the normal way and refreshing the page
        
    });

	
							pubnub.subscribe({
						channel: "vid_done_<?php echo $user_unid; ?>",
						message: function(m) {
						if (m.state == "load"){	
						product_unid = m.prod_unid;
						$.get("ajax_videos.php?user=<?php echo $user_unid; ?>&unid=" + product_unid, function(datavid) {
						$("#videos").html('');
						$("#videos").html(datavid);
						});
						}
						}});	
	
						pubnub.subscribe({
						channel: "pic_done_<?php echo $user_unid; ?>",
						message: function(m) {
						if (m.state == "load"){	
						product_unid = m.prod_unid;
						$.get("ajax_photos.php?user=<?php echo $user_unid; ?>&unid=" + product_unid, function(data2) {
						$("#photos").html('');
						$("#photos").html(data2);
						});
						}
						}});	
});

    </script>
<div id="photobooth" >
<div class="row">
<div class="col-sm-12">
<h3>HDD Shredding</h3>
<hr />
</div>
</div>
<div class="row" >
	<div class="col-md-12">



	<p><button class="btn btn-large" type="submit" onClick="new_product()" name="submit" value="submit">Done with Product</button></p>
	<div id="message"></div>
	</div>
	</div>
	
	
		<div class="row" >

		<div class="col-md-6">
	<div id="webcam"></div>

	</div>

	<div class="col-md-6">
	<div id="webcam_results">
	<div id="mediaplayer" style="display:none;"></div>
	<button id="recordStopButton" class="btn btn-small" onclick="closeCamera()">Stop Recording</button>
	</div>

	</div>
</div>
	
	
	
	<div class="row" >

		<div class="col-md-6">
	<div id="videos"></div>

	</div>

	<div class="col-md-6">
	<div id="photos" ></div>

	</div>
</div>
	

	
	</div>
	
	
	
	
	<!-- First, include the Webcam.js JavaScript Library -->

	<!-- Configure a few settings and attach camera -->

	

	<script language="JavaScript">
	var data_urik = "jhj";
		function take_snapshot() {
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById('results').innerHTML =  
					'<img src="'+data_uri+'"/>';
					data_urik = data_uri;
					

					
					
					
			} );
			
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		}
		function send_info(){
			 Webcam.upload( data_urik, upload_url, function(code, text) {
            // Upload complete!
            // 'code' will be the HTTP response code from the server, e.g. 200
            // 'text' will be the raw response content
        } );
		
		

		
		
		}

		function new_product(){
			$("#photobooth").hide();
			$("#product_form").show();
			page = "form";
			$("#videos").html('');
			$("#photos").html('');
			$("#videos").html('');
			$("#mediaplayer").html('');
			document.getElementById("unid").value = '';
			document.getElementById('unid').focus();
			document.getElementById("unid").value = '';
			setTimeout(function(){
			document.getElementById("unid").value = '';
			}, 500);
		}
		
		

	</script>






<div id="product_form" >
<div class="row">
<div class="col-sm-12">
<h3>HDD Shredding</h3>

<hr />
</div>
</div>
<div class="row">
<div class="col-sm-6">
</div>
<div class="col-sm-6">
			<p>Scan Sku</p>
		<hr />
		<form id="form_sku" method="post">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>Product Id:</td>
    <td><?php echo generateTextAuto('unid', '', 'false');  ?><td>
  </tr>
  <tr style="height: 35px;">

  <tr>
     <td><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></td>
	 </form>
    <td></td>
  </tr>
</table>
</div>
</div>
</div>	
<?php	

echo $footer;
?>