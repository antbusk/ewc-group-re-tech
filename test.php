<?php
require("login_check.php");
echo $header;	
?>

<script>

function findPrinter(){
var printer_s = document.getElementById('printer').value;
pubnub.publish({
    channel: 'test',
    message: {"state":"detect_print", "value": "" + printer_s, "value_2":""}
 });
}

function printPDF(){

pubnub.publish({
    channel: 'test',
    message: {"state":"print_pdf", "value":"", "value_2":"2", }
 });
}
</script>
<input type="button" onClick="findPrinter()" value="Detect Printer"><br />
<input id="printer" type="text" value="zebra" size="15"><br />
<input type="button" onClick="printPDF()" value="Print PDF" /><br />
<input type="text" id="copies" size="8" value="1" />


<?php

echo $footer;

?>