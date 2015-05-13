<?php
require("login_check.php");


echo $header;	

?>

<div class="row">
<div class="col-sm-12">
<h3>Search Sku</h3>
<hr />
</div>
</div>


<div class="row" >
	<div class="col-md-6">
	</div>
	
	<div class="col-md-6">
			<p>Scan Sku</p>
		<hr />
		<form action="sku.php" method="get">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>SKU Id:</td>
    <td><?php echo generateTextAuto('sku');  ?><td>
  </tr>
  <tr style="height: 35px;">

  <tr>
    <td><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></td>
    <td></td>
  </tr>
</table>

<!-- begin form footer -->

</form>
<!-- end form footer -->
	
	
	
	</div>
	</div>
	



<?php echo $footer; ?>