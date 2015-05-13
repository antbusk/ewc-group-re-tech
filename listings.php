<?php
require("login_check.php");
$main_table = 'listings';
$error = '';
$row_listing['f1'] = '';
$row_listing['f2'] = '';
$row_listing['f3'] = '';
$row_listing['f4'] = '';
$row_listing['f5'] = '';
$row_listing['f6'] = '';
$row_listing['f7'] = '';
if(isset($_GET['search_by'])) {
if($_GET['search_by'] == '1'){
$search_by = 'listings.f1';
} else {
$search_by = 'listings.unid';
}
}
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
$f3 =  mysql_real_escape_string($_POST[$main_table . '_f3']);
$f4 =  mysql_real_escape_string($_POST[$main_table . '_f4']);
$f5 =  mysql_real_escape_string($_POST[$main_table . '_f5']);
$f6 =  mysql_real_escape_string($_POST[$main_table . '_f6']);
$f7 =  mysql_real_escape_string($_POST[$main_table . '_f7']);


if ($insert_or_edit == 'insert') {    // insert beggin

	// insert into db
	$query1 = "INSERT INTO $main_table ( sub_unid, f1, f2, f3, f4, f5, f6, f7) VALUES ('$account_bridge', '$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7')";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done

$_SESSION['last_insert']= mysql_insert_id();

}   // insert end
 
 
 
 
if ($insert_or_edit == 'edit'){    // edit begin

// update db
$query = "UPDATE $main_table SET f1='$f1', f2='$f2', f3='$f3', f4='$f4', f5='$f5', f6='$f6', f7='$f7' WHERE unid = '$submit_edit_listing_unid' AND sub_unid = '$account_bridge' ";
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
$query_listing = "SELECT * FROM $main_table WHERE $search_by = '$edit_listing_unid' AND sub_unid = '$account_bridge'";
$result_listing = mysql_query($query_listing);
if (!$result_listing) {
  die('Invalid query: ' . mysql_error());
}
$row_listing = mysql_fetch_assoc($result_listing);

} // end get listing info
	
	
/// get list of listings	
	$query4 = "SELECT * FROM listings WHERE sub_unid = '$account_bridge' ORDER BY unid DESC";
$result = mysql_query($query4);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
/// end list of listings
	
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



	

// Select all the rows in the markers table
	$query_barcode = "SELECT * FROM listings WHERE sub_unid = '$account_bridge' AND unid = '$lastid'";
$result_barcode = mysql_query($query_barcode);
if (!$result_barcode) {
  die('Invalid query: ' . mysql_error());
}

$row_barcode = mysql_fetch_assoc($result_barcode);
?>

<script>
function openWin()
{
window.open("includes/shelfBarCode.php?unid=<?php echo $row_barcode['unid'] . '&f1=' . $row_barcode['f1'] . '&f2=' . $row_barcode['f2'] . '&f3=' . $row_barcode['f3'] . '&f4=' . $row_barcode['f4'] . '&f5=' . $row_barcode['f5'] . '&f6=' . $row_barcode['f6'] . '&f7=' . $row_barcode['f7']; ?>","_blank","toolbar=no, scrollbars=no, resizable=yes, top=20, left=20, width=400, height=400");
}
openWin();



</script>
    
<?php 
}
$total_sales = '';
$total_shipping = '';
?>
<?php ob_start(); ?>
<div class="row-fluid"><!-- contents row 1 oppening tag -->
<div class="span12">
<table id="myTable" class="table table-condensed table-hover"> 
<thead> 
<tr> 
	<th>UnId</th>
    <th>eBay Id</th>
	<th>Status</th>
    <th>Sold Price</th> 
    <th>Shipping Cost</th> 
    <th>Date Created</th> 
    <th>Date Sold</th>

    <th style="text-align: center;">PRINT</th>
    <th style="text-align: center;">EDIT</th>
    <th style="text-align: center;">DELETE</th> 
</tr> 
</thead> 
<tbody> 
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
<tr>
	<td><a href="product_to_listings.php?listingId=<?php echo $row['unid']; ?>"><?php echo $row['unid']; ?></a></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['f2']; ?></td> 
    <td><?php echo $row['f3']; ?></td> 
    <td><?php echo $row['f4']; ?></td> 
    <td><?php echo $row['f5']; ?></td>
    <td><?php echo $row['f6']; ?></td> 

<td style="text-align: center;"><a href="#"  class="btn btn-large btn-info msgbox-confirm"><i class="glyphicon glyphicon-barcode"></i></a></td>

    <td style="text-align: center;"><a href="<?php echo $main_table; ?>.php?edit_listing_unid=<?php echo $row['unid'] ?>" class="btn btn-large btn-info msgbox-confirm" ><i class="glyphicon glyphicon-list"></i></a></td>
     
    <td style="text-align: center;"><a onclick="if(!confirm('Are you sure that you want to permanently delete the selected element?'))return false" class="btn btn-large btn-info msgbox-confirm" href="<?php echo $main_table; ?>.php?delete_listing=<?php echo $row['unid']; ?>"><i class="glyphicon glyphicon-remove-circle"></i></a></td> 
</tr> 
<?php 
$total_sales = $total_sales + $row['f3'];
$total_shipping = $total_shipping + $row['f4'];


} 
$net_sales = $total_sales - $total_shipping;
?>
</tbody>
</table>
</div>
</div>
<?php 


$listings1 = ob_get_clean(); 

$array_search_by = array
  (
  array("unid" => "1","f1" => "eBay Listing"), 
  array("unid" => "2", "f1" => "Unid"),
  array("unid" => "3", "f1" => "Product Id")

  );


?>



<form action="product_to_listings.php" method="GET">
<div class="row">
<div class="col-sm-2"><h3>Listings</h3></div>
<div class="col-sm-1"><h5>Search:</h5></div>
<div class="col-sm-2"><?php echo generateSelect('search_by', $array_search_by, '');  ?></div>
<div class="col-sm-2"><?php echo generateText('listingId', '');  ?></div>
<div class="col-sm-2"><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></div>
<div class="col-sm-3"></div>

</div>
</form>
<div class="row">
<div class="col-sm-12"><hr /></div>
</div>


<div class="row" >
	<div class="col-md-6">
	    		<ul class="nav nav-pills nav-stacked">
  <li class="active"><a href="#"><span class="badge pull-right"><?php echo $total_sales; ?></span>Total Sales</a></li>
  <li class="active"><a href="#"><span class="badge pull-right"><?php echo $total_shipping; ?></span>Total Shipping</a></li>
  <li class="active"><a href="#"><span class="badge pull-right"><?php echo $net_sales; ?></span>Net Sales</a></li>

</ul>
<br>
				<p>Scan Listing</p>
		<hr />
		<form action="listings.php" method="get">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>Listing Id:</td>
    <td>
	
	<div class="row">
	<div class="col-sm-6"><?php echo generateSelect('search_by', $array_search_by, '');  ?></div>
	<div class="col-sm-6"><?php echo generateText('edit_listing_unid', '');  ?></div>
</div>
	
	<td>
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
	<div class="col-md-6">
		<p>Add Listing</p>
		<hr />
		<form action="<?php echo $main_table; ?>.php" method="post">
<table width="100%" border="0">
  <tr style="height: 35px;">
    <td>eBay Id:</td>
    <td><?php echo generateText($main_table . '_f1', $row_listing['f1']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Status:</td>
    <td><?php echo generateSelect($main_table . '_f2', $array_listing_cat, $row_listing['f2']);  ?><td>
  </tr
  <tr style="height: 35px;">
    <td>Sold Price:</td>
    <td><?php echo generateText($main_table . '_f3', $row_listing['f3']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Shipping Cost:</td>
    <td><?php echo generateText($main_table . '_f4', $row_listing['f4']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Date Created:</td>
    <td><?php echo generateText($main_table . '_f5', $row_listing['f5']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Date Sold:</td>
    <td><?php echo generateText($main_table . '_f6', $row_listing['f6']);  ?><td>
  </tr>
   <tr style="height: 35px;">
    <td>HTML:</td>
    <td><?php echo generateText($main_table . '_f7', $row_listing['f7']);  ?><td>
  </tr>
  <tr>
    <td><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></td>
    <td></td>
  </tr>
</table>

<!-- begin form footer -->
<?php if(isset($_GET['edit_listing_unid'])) { echo '<input type="hidden" name="submit_edit_listing_unid" value="' . $row_listing['unid']. '" />'; }  ?>
<input type="hidden" name="insert_or_edit" value="<?php if (isset($_GET['edit_listing_unid'])) { echo 'edit'; } else { echo 'insert'; } ?>">
<input type="hidden" name="submit-1"  value="submit" />
</form>
<!-- end form footer -->

	</div>
</div>







<?php echo $listings1; ?>

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