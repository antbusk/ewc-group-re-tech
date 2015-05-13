<?php
require("login_check.php");



echo $header;

?>



<div id="div1">
<p id="p1">Devices Online</p>

</div>
















<script type="text/javascript">
//Subscribe to the demo_tutorial channel

var m;


        pubnub.subscribe({
          channel: 'test',
          message: function(m) {
		 
		  
		  



var para = document.createElement("p");
var node = document.createTextNode(m.unid);

para.appendChild(node);

var element = document.getElementById("div1");
element.appendChild(para);

		  
  
		  }
        });
</script>



<?php
echo $footer;

?>