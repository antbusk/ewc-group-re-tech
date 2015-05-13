<?php
require("login_check.php");
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
$main_table = 'product_to_listings';
$second_table = 'listings';
$error = '';
$row_listing['f1'] = '';
$row_listing['f8'] = '';
$row_listing['f3'] = '';

$listingUnid =  mysql_real_escape_string($_POST['listingID']);
if(isset($_GET['listingId'])) {
	$_SESSION['listingID'] = mysql_real_escape_string($_GET['listingId']);
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
	
$f1 =  mysql_real_escape_string($_POST[$second_table . '_f1']);
$f8 =  mysql_real_escape_string($_POST[$second_table . '_f8']);



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
$query = "UPDATE $second_table SET f1='$f1', f8='$f8' WHERE unid = '$submit_edit_listing_unid' AND sub_unid = '$account_bridge' ";
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
 
// Select all the rows in the markers table
$query_listing = "SELECT * FROM $second_table WHERE unid = '$listingID' AND sub_unid = '$account_bridge'";
$result_listing = mysql_query($query_listing);
if (!$result_listing) {
  die('Invalid query: ' . mysql_error());
}
$row_listing = mysql_fetch_assoc($result_listing);

 // end get listing info
	

/// get list of listings	
	$query4 = "SELECT *, product_to_listings.unid AS unid, products.unid AS prod_unid, products.f1 AS prodf1, products.f2 AS prodf2, products.f3 AS prodf3, products.f4 AS prodf4, products.f5 as prodf5, products.f6 AS prodf6, products.f7 AS prodf7, products.f8 AS prodf8, products.f9 AS prodf9, products.f10 AS prodf10, listings.unid AS list_unid, listings.f1 AS listf1, product_types.unid AS cat_unid FROM $main_table INNER JOIN (listings) ON (listings.unid=$main_table.f1) INNER JOIN (products) ON (products.unid=$main_table.f2) INNER JOIN (product_types) ON (product_types.unid=products.f1) WHERE products.sub_unid = '$account_bridge' AND product_to_listings.f1 = '$listingID' ORDER BY products.unid DESC";
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
  <li class="active"><a href="#"><span class="badge pull-right"><?php echo $count1; ?></span>Product Quanity</a></li>
  <li class="active"><a href="listing_inventory_audit.php"><span class="badge pull-right"><?php echo $count1; ?></span>Listing inventory Audit</a></li>


  ...
</ul>
    
    </div>
	<div class="col-md-6">
		<p>Enter eBay Listing #</p>
		<hr />
		<form action="product_to_listings_results.php" method="post">
<table width="100%" border="0">

  <tr style="height: 35px;">
    <td>eBay Listing #:</td>
    <td><?php echo generateText($second_table . '_f1', $row_listing['f1']);  ?><td>

  </tr>
  
  <tr style="height: 35px;">
	<td># of days the listing lasts</td>
	<td><?php echo generateText($second_table . '_f8', $row_listing['f8']);  ?><td>
  </tr>
  <tr>
    <td><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></td>
    <td></td>
  </tr>
</table>

<!-- begin form footer -->
<input type="hidden" name="submit_edit_listing_unid" value="<?php echo $listingID; ?>" />
<input type="hidden" name="insert_or_edit" value="edit">
<input type="hidden" name="submit-1"  value="submit" />
</form>

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
	<th>P/N</th>
    <th>Serial</th>
    <th>Asset Tag</th>
	<th>Piece Count</th>
	<th>Gross</th>
    <th>Tare</th>
	<th>Net</th>
    <th>Notes</th>
</tr> 
</thead> 
<tbody> 
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
<tr>
<?php 
$net_weight = $row['prodf6'] - $row['prodf8']; ?>
	<td><?php echo $row['list_unid']; ?></td>
	<td><?php echo $row['prod_unid']; ?></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['prodf2']; ?></td> 
    <td><?php echo $row['prodf3']; ?></td>
	<td><?php echo $row['prodf10']; ?></td>
    <td><?php echo $row['prodf4']; ?></td> 
    <td><?php echo $row['prodf5']; ?></td>
	<td><?php echo $row['prodf9']; ?></td>
	<td><?php echo $row['prodf6']; ?></td>
    <td><?php echo $row['prodf8']; ?></td>
	<td><?php echo $net_weight; ?></td>
    <td><?php echo $row['prodf7']; ?></td>
    


<?php $total_weight = $total_weight + $row['prodf6']; 
$total_net_weight = $total_net_weight + $net_weight;
$total_tare = $total_tare + $row['prodf8'];
$total_quantity = $total_quantity + $row['prodf9']; 

?> 
 
</tr> 
<?php } ?>
</tbody>
</table>
<table id="myTable" class="table table-condensed table-hover"> 
<thead> 

<tr style="border-top-width: 2px">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
    <td></td> 
	<td></td>
	<td></td>
	<td>Total Piece Count:</td>
	<td><?php echo $total_quantity ?></td>

	<td colspan="2">Gross Weight:</td>
    <td><?php echo $total_weight; ?></td>
	<td></td>
</tr>
<tr >

	<td></td>
	<td></td>
    <td></td> 
    <td></td>
	<td></td>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan="2">Tare Weight:</td>
    <td><?php echo $total_tare; ?></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>  
	<td></td>
	<td></td>
	<td></td>
	<td></td>

	<td colspan="2">Net Weight:</td>
    <td><?php echo $total_net_weight; ?></td>
	<td></td>
</tr>
</tbody>
</table>

<textarea cols="40" rows="5" name="myname">
<table class="myTable" style="border-collapse: collapse;color: white;background-color: #585858;width: 100%;"> 
<thead> 
<tr class="border_bottom211" style="border-bottom-style: solid;border-bottom-color: white;border-bottom-width: 2px;"> 
	<th><b>Listing Id</b></th>
    <th><b>Product Id</b></th>
    <th><b>Type</b></th> 
    <th><b>Make</b></th> 
    <th><b>Model</b></th>
	<th><b>P/N</b></th>
    <th><b>Serial</b></th>
    <th><b>Asset Tag</b></th>
	<th><b>Piece Count</b></th>
	<th><b>Gross</b></th>
    <th><b>Tare</b></th>
	<th><b>Net</b></th>
    <th><b>Notes</b></th>
</tr> 
</thead> 
<tbody> 
<?php mysql_data_seek($result, 0);
while($row = mysql_fetch_assoc($result)){ ?>
<tr class="border_bottom111" style="border-bottom-style: solid;border-bottom-color: white;border-bottom-width: 1px;">
<?php 
$net_weight = $row['prodf6'] - $row['prodf8']; ?>
	<td><?php echo $row['list_unid']; ?></td>
	<td><?php echo $row['prod_unid']; ?></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['prodf2']; ?></td> 
    <td><?php echo $row['prodf3']; ?></td>
	<td><?php echo $row['prodf10']; ?></td>
    <td><?php echo $row['prodf4']; ?></td> 
    <td><?php echo $row['prodf5']; ?></td>
	<td><?php echo $row['prodf9']; ?></td>
	<td><?php echo $row['prodf6']; ?></td>
    <td><?php echo $row['prodf8']; ?></td>
	<td><?php echo $net_weight; ?></td>
    <td><?php echo $row['prodf7']; ?></td>
    


<?php 

?> 
 
</tr> 
<?php } ?>
</tbody>
</table>


<table class="myTable" style="border-collapse: collapse;color: white;background-color: #585858;width: 100%;" > 
<thead> 

<tr id="border_bottom111"style="border-bottom-style: solid;border-bottom-color: white;border-bottom-width: 1px;">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
    <td></td> 
	<td></td>
	<td></td>
	<td>Total Piece Count:</td>
	<td><?php echo $total_quantity ?></td>

	<td colspan="2">Gross Weight:</td>
    <td><?php echo $total_weight; ?></td>
	<td></td>
</tr>
<tr class="border_bottom111" style="border-bottom-style: solid;border-bottom-color: white;border-bottom-width: 1px;">

	<td></td>
	<td></td>
    <td></td> 
    <td></td>
	<td></td>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan="2">Tare Weight:</td>
    <td><?php echo $total_tare; ?></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>  
	<td></td>
	<td></td>
	<td></td>
	<td></td>

	<td colspan="2">Net Weight:</td>
    <td><?php echo $total_net_weight; ?></td>
	<td></td>
</tr>
</tbody>
</table>

<table style="width:100%">
  <tr>
    <td>

<?php mysql_data_seek($result, 0);
while($row = mysql_fetch_assoc($result)){ ?>
<p>
<table class="myTable" style="border-collapse: collapse;color: white;background-color: #585858;width: 100%;"> 
<thead> 
<tr class="border_bottom211" style="border-bottom-style: solid;border-bottom-color: white;border-bottom-width: 2px;"> 
	<th><b>Listing Id</b></th>
    <th><b>Product Id</b></th>
    <th><b>Type</b></th> 
    <th><b>Make</b></th> 
    <th><b>Model</b></th>
	<th><b>P/N</b></th>
    <th><b>Serial</b></th>
    <th><b>Asset Tag</b></th>
	<th><b>Piece Count</b></th>
	<th><b>Gross</b></th>
    <th><b>Tare</b></th>
	<th><b>Net</b></th>
    <th><b>Notes</b></th>
</tr> 
</thead> 
<tbody> 
<?php 
$prod_unid = $row['prod_unid'];
$query_photos = "SELECT * FROM photos WHERE prod_unid = '$prod_unid' ORDER BY `order` ASC";

$result_photos = mysql_query($query_photos);
if (!$result_photos) {
  die('Invalid query: ' . mysql_error());
	}
?>
<tr class="border_bottom111"style="border-bottom-style: solid;border-bottom-color: white;border-bottom-width: 1px;">
<?php 
$net_weight = $row['prodf6'] - $row['prodf8']; ?>
	<td><?php echo $row['list_unid']; ?></td>
	<td><?php echo $row['prod_unid']; ?></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['prodf2']; ?></td> 
    <td><?php echo $row['prodf3']; ?></td>
	<td><?php echo $row['prodf10']; ?></td>
    <td><?php echo $row['prodf4']; ?></td> 
    <td><?php echo $row['prodf5']; ?></td>
	<td><?php echo $row['prodf9']; ?></td>
	<td><?php echo $row['prodf6']; ?></td>
    <td><?php echo $row['prodf8']; ?></td>
	<td><?php echo $net_weight; ?></td>
    <td><?php echo $row['prodf7']; ?></td>
</tr> 

</tbody>
</table>
</td>
 </tr>
  <tr>
    <td>

<?php
		while($row_photos = mysql_fetch_assoc($result_photos))
			
		{
$pic_id = $row_photos['unid'];			
$object_image_file = 'gs://ewc-group-re-tech.appspot.com/photos/' . $pic_id . '.jpg';
$object_image_url = CloudStorageTools::getImageServingUrl($object_image_file,
                                            ['size' => 200, 'crop' => false]);

$object_image_file2 = 'gs://ewc-group-re-tech.appspot.com/photos/' . $pic_id . '.jpg';
$object_image_url2 = CloudStorageTools::getImageServingUrl($object_image_file2,
                                            ['size' => 0, 'crop' => false]);

?>
<a href="<?php echo $object_image_url2; ?>">
<img src="<?php echo $object_image_url; ?>" width="200" height="180">
</a>
<?php 
}
?> 
</td>
  </tr>
</table>
<hr />
<?php } ?>
</textarea>

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