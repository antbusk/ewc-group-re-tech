<?php
error_reporting(E_ALL);
require("login_check.php");
$main_table = 'products';
$error = '';
	
	///// get listing info
if(isset($_GET['sku'])) {
 $sku = $_GET['sku'];
// Select all the rows in the markers table
$query_listing = "SELECT * FROM sku WHERE unid = '$sku' AND sub_unid = '$account_bridge'";
$result_listing = mysql_query($query_listing);
if (!$result_listing) {
  die('Invalid query: ' . mysql_error());
}
$row_listing = mysql_fetch_assoc($result_listing);

} // end get listing info
	
	

	
/// get list of listings	
	$query4 = "SELECT *,
	products.unid AS prod_unid,
	product_types.f1 AS prod_t,
	product_types.unid AS cat_unid, 
	shelf.f1 AS shelf_f1,
	shelf.unid AS shelf_unid
	FROM $main_table
	INNER JOIN (product_types) ON (product_types.unid=$main_table.f1) 
	INNER JOIN (shelf) ON (shelf.unid=products.shelf_unid) 
	WHERE $main_table.sub_unid = '$account_bridge' AND products.sku_unid = '$sku' AND products.instock = '1'
	ORDER BY products.unid DESC";
	

						
						$result = mysql_query($query4);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
/// end list of listings
	


echo $header;	



	

?>


<div class="row">
<div class="col-sm-12">
<h3>Products from SKU</h3>
<hr />
</div>
</div>




<div class="row" >
	<div class="col-md-6">
<p>SKU Info</p>
<hr />
<table width="100%" border="0">
  <tr style="height: 35px;">
    <td>Sku:</td>
    <td><?php echo $row_listing['unid'] ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Title:</td>
    <td><?php echo $row_listing['sf3'] ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>ASIN:</td>
    <td><?php echo $row_listing['sf14'] ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>UPC:</td>
    <td><?php echo $row_listing['sf11'] ?><td>
  </tr>

</table>

	</div>
	<div class="col-md-6">

<p></p>





	</div>
</div>









<div class="row-fluid"><!-- contents row 1 oppening tag -->
<div class="span12">
<table id="myTable" class="table table-condensed table-hover"> 
<thead> 
<tr> 
	<th>UnId</th>
    <th>Barcode</th>
	<th>Type</th>
    <th>Make</th> 
    <th>Model</th> 
    <th>Serial</th> 
    <th>Shelf UnId</th> 
    <th>Shelf Name</th> 



</tr> 
</thead> 
<tbody> 
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
<tr>
	<td><?php echo $row['prod_unid']; ?></td>
	<td><img alt="barcode" src="includes/barcode_img.php?text=<?php echo $row['prod_unid']; ?>" /></td>
	<td><?php echo $row['prod_t']; ?></td>
    <td><?php echo $row['f2']; ?></td> 
    <td><?php echo $row['f3']; ?></td> 
    <td><?php echo $row['f4']; ?></td> 
    <td><?php echo $row['shelf_unid']; ?></td> 
    <td><?php echo $row['shelf_f1']; ?></td> 
 



     
</tr> 
<?php } ?>
</tbody>
</table>
</div>
</div>

        <script type="text/javascript">

$("#products_f1").change(function() {
  val = $(this).val();

      var html = $.ajax({
   url: "products_dropdownselect.php?f1="+val+"",
   async: true,
   success: function(data) {

$('#sub_catagory').html(data);
 }////////////fuction html////////
 })/////////function ajax//////////

  
});
    </script>

<?php echo $footer; ?>