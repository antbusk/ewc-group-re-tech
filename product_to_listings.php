<?php
require("login_check.php");
$main_table = 'product_to_listings';
$error = '';
$row_listing['f1'] = '';
$row_listing['f2'] = '';

if($_GET['search_by'] == '1'){
$search_by = 'listings.f1';
} else {
$search_by = 'listings.unid';
}


$listingUnid =  mysql_real_escape_string($_POST['listingID']);
if(isset($_GET['listingId'])) {
	$_SESSION['listingID'] = $_GET['listingId'];
}

$listingID = $_SESSION['listingID'];

if(isset($_GET['edit_listing_unid'])) {
	$edit_listing_unid = mysql_real_escape_string($_GET['edit_listing_unid']);
	$_SESSION['last_updated_id'] = $edit_listing_unid;
}

if(isset($_POST['submit_edit_listing_unid'])){
	$submit_edit_listing_unid = $_POST['submit_edit_listing_unid'];
	
}
if(isset($_POST['submit-1'])) { ////// start submit post
	
$insert_or_edit = mysql_real_escape_string($_POST['insert_or_edit']);
	
$f1 =  mysql_real_escape_string($_POST[$main_table . '_f1']);
$f2 =  mysql_real_escape_string($_POST[$main_table . '_f2']);


if ($insert_or_edit == 'insert') {    // insert beggin

	// insert into db
	$query1 = "INSERT INTO $main_table ( sub_unid, f1, f2) VALUES ('$account_bridge', '$f1', '$f2')";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done

$_SESSION['last_insert']= mysql_insert_id();

}   // insert end
 
 
 
 
if ($insert_or_edit == 'edit'){    // edit begin

// update db
$query = "UPDATE $main_table SET f1='$f1', f2='$f2' WHERE unid = '$submit_edit_listing_unid' AND sub_unid = '$account_bridge' ";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
	}
// done


} // edit end
 
}// emd submit post

// delete listing
if (isset($_GET['delete_listing'])) {
$unid = $_GET['delete_listing'];
		$query5 = "DELETE FROM $main_table WHERE sub_unid = '$account_bridge' and unid = '$unid'";
$result5 = mysql_query($query5);
if (!$result5) {
  die('Invalid query: ' . mysql_error());
}	
} // end delete listing 
	
	///// get listing info
if(isset($_GET['edit_listing_unid'])) {
 
// Select all the rows in the markers table
$query_listing = "SELECT * FROM $main_table WHERE unid = '$edit_listing_unid' AND sub_unid = '$account_bridge'";
$result_listing = mysql_query($query_listing);
if (!$result_listing) {
  die('Invalid query: ' . mysql_error());
}
$row_listing = mysql_fetch_assoc($result_listing);

} // end get listing info
	
if($_GET['search_by'] == '3'){
$query_search = "SELECT * From listing_to_products WHERE f2 = '$listingID'";
$result_search	= msql_query($query_search);
if(!$result_search){
  die('Invalid query:' . mysql_error());
}

while ($row_search = @mysql_fetch_assoc($result_search)){

$listingID = $row_search['f1'];

}
}

	
/// get list of listings	
	$query4 = "SELECT *, product_to_listings.unid AS unid, products.unid AS prod_unid, products.f1 AS prodf1, products.f2 AS prodf2, products.f3 AS prodf3, products.f4 AS prodf4, products.f5 as prodf5, products.f6 AS prodf6, listings.unid AS list_unid, listings.f1 AS listf1, product_types.unid AS cat_unid FROM $main_table INNER JOIN (listings) ON (listings.unid=$main_table.f1) INNER JOIN (products) ON (products.unid=$main_table.f2) INNER JOIN (product_types) ON (product_types.unid=products.f1) WHERE products.sub_unid = '$account_bridge' AND $search_by = '$listingID' ORDER BY products.unid DESC";
$result = mysql_query($query4);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
/// end list of listings
$count1 = mysql_num_rows($result);

	
	// get dropdown menue of location types	
	$query_listing_cat = "SELECT * FROM product_types";
$result_listing_cat = mysql_query($query_listing_cat);
if (!$result_listing_cat) {
  die('Invalid query: ' . mysql_error());
}


while( $row_listing_cat = mysql_fetch_assoc( $result_listing_cat)){ $array_listing_cat[] = $row_listing_cat; }
// end dropdown menue of location types


echo $header;	



if(isset($_POST['submit-1'])) {
	if(isset($submit_edit_listing_unid)){
		$lastid = $submit_edit_listing_unid;
		
}else{
		$lastid = $_SESSION['last_insert'];
		;
	}



	


?>


    
<?php 
}
?>

<div class="row">
<div class="col-sm-12">
<h3>Products</h3>
<hr />
</div>
</div>




<div class="row" >
	<div class="col-md-6">
    		<ul class="nav nav-pills nav-stacked">
  <li class="active"><a href="product_to_listings_results.php?listingId=<?php echo $listingID ?>"><span class="badge pull-right"><?php echo $count1; ?></span>Product Quanity</a></li>


  ...
</ul>
    
    </div>
	<div class="col-md-6">
		<p>Add Product</p>
		<hr />
		<form action="<?php echo $main_table; ?>.php" method="post">
<table width="100%" border="0">
  <tr style="height: 35px;">
    <td>Listing Id:</td>
    <td><?php echo generateTextRead($main_table . '_f1', $listingID);  ?><td>
  </tr>
    <tr style="height: 35px;">
    <td>Product Id:</td>
    <td><?php echo generateTextAuto($main_table . '_f2', $row_listing['f2']);  ?><td>
  </tr>
  <tr style="height: 35px;">

  <tr>
    <td><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></td>
    <td></td>
  </tr>
</table>

<!-- begin form footer -->
<?php if(isset($_GET['edit_listing_unid'])) { echo '<input type="hidden" name="submit_edit_listing_unid" value="' . $_GET['edit_listing_unid']. '" />'; }  ?>
<input type="hidden" name="insert_or_edit" value="<?php if (isset($_GET['edit_listing_unid'])) { echo 'edit'; } else { echo 'insert'; } ?>">
<input type="hidden" name="submit-1"  value="submit" />
</form>
<!-- end form footer -->

	</div>
</div>









<div class="row-fluid"><!-- contents row 1 oppening tag -->
<div class="span12">
<table id="myTable" class="table table-condensed table-hover"> 
<thead> 
<tr> 
	<th>Listing Id</th>
    <th>Product Id</th>
    <th>Type</th> 
    <th>Make</th> 
    <th>Model</th> 
    <th>Serial</th>
    <th>Asset Tag</th>
    <th>Weight</th>
    <th style="text-align: center;">PRINT</th>
    <th style="text-align: center;">EDIT</th>
    <th style="text-align: center;">DELETE</th> 
</tr> 
</thead> 
<tbody> 
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
<tr>
	<td><?php echo $row['list_unid']; ?></td>
	<td><?php echo $row['prod_unid']; ?></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['prodf2']; ?></td> 
    <td><?php echo $row['prodf3']; ?></td> 
    <td><?php echo $row['prodf4']; ?></td> 
    <td><?php echo $row['prodf5']; ?></td>
    <td><?php echo $row['prodf6']; ?></td> 

<td style="text-align: center;"><a href="#"  class="btn btn-large btn-info msgbox-confirm"><i class="glyphicon glyphicon-barcode"></i></a></td>

    <td style="text-align: center;"><a href="<?php echo $main_table; ?>.php?edit_listing_unid=<?php echo $row['unid'] ?>" class="btn btn-large btn-info msgbox-confirm" ><i class="glyphicon glyphicon-list"></i></a></td>
     
    <td style="text-align: center;"><a onclick="if(!confirm('Are you sure that you want to permanently delete the selected element?'))return false" class="btn btn-large btn-info msgbox-confirm" href="<?php echo $main_table; ?>.php?delete_listing=<?php echo $row['unid']; ?>"><i class="glyphicon glyphicon-remove-circle"></i></a></td> 
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