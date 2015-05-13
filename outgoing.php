<?php
require("login_check.php");

if(isset($_POST['product'])){
$id = mysql_real_escape_string($_POST['product']);

// update db
$query = "UPDATE products SET instock='0' WHERE unid = '$id' AND sub_unid = '$account_bridge' ";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
	}
// done
}
echo $header;	

?>

<div class="row">
<div class="col-sm-12">
<h3>Out Going Products</h3>
<hr />
</div>
</div>


<div class="row" >
	<div class="col-md-6">
	</div>
	
	<div class="col-md-6">
			<p>Scan Sku</p>
		<hr />
		<form action="outgoing.php" method="post">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>Product Id:</td>
    <td><?php echo generateTextAuto('product');  ?><td>
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