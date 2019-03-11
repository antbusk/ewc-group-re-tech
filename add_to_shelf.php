<?php
require("login_check.php");


echo $header;	
///// login check hello world
?>


<div class="row">
<div class="col-sm-12">
<h3>Add to Shelf</h3>
<hr />
</div>
</div>


<div class="row" >
	<div class="col-md-6">
	</div>
	
	<div class="col-md-6">
			<p>Scan Product</p>
		<hr />
		<form action="add_to_shelf_step_2.php" method="get">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>Product Id:</td>
    <td><?php echo generateTextAuto('edit_listing_unid');  ?><td>
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
