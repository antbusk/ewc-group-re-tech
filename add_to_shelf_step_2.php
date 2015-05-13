<?php
if(isset($_POST['submit_edit_listing_unid'])){
$redirect = 'true';
$redirect_url = 'add_to_shelf.php';	
}

require("login_check.php");
$main_table = 'products';
$error = '';
$row_listing['f1'] = '';


if(isset($_GET['edit_listing_unid'])) {
	$edit_listing_unid = mysql_real_escape_string($_GET['edit_listing_unid']);
	$_SESSION['last_updated_id'] = $edit_listing_unid;
}

if(isset($_POST['submit_edit_listing_unid'])){
	$submit_edit_listing_unid = $_POST['submit_edit_listing_unid'];
	
}
if(isset($_POST['submit-1'])) { ////// start submit post
	
$insert_or_edit = mysql_real_escape_string($_POST['insert_or_edit']);
	
$f1 =  mysql_real_escape_string($_POST[$main_table . '_shelf_unid']);



if ($insert_or_edit == 'insert') {    // insert beggin

	// insert into db
	$query1 = "INSERT INTO $main_table ( sub_unid, shelf_unid) VALUES ('$account_bridge', '$f1')";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done

$_SESSION['last_insert']= mysql_insert_id();

}   // insert end
 
 
 
 
if ($insert_or_edit == 'edit'){    // edit begin

// update db
$query = "UPDATE $main_table SET shelf_unid='$f1' WHERE unid = '$submit_edit_listing_unid' AND sub_unid = '$account_bridge' ";
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
if(!$edit_listing_unid){
$listing_unid = $submit_edit_listing_unid;
}else {
$listing_unid = $edit_listing_unid;
}	
	
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
	WHERE $main_table.sub_unid = '$account_bridge' AND products.unid = '$listing_unid' 
	ORDER BY products.unid DESC";
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
	$query_barcode = "SELECT *, $main_table.unid AS unid, product_types.unid AS cat_unid FROM $main_table INNER JOIN (product_types) ON (product_types.unid=$main_table.f1) WHERE $main_table.sub_unid = '$account_bridge' AND $main_table.unid = '$lastid'";
$result_barcode = mysql_query($query_barcode);
if (!$result_barcode) {
  die('Invalid query: ' . mysql_error());
}

$row_barcode = mysql_fetch_assoc($result_barcode);
?>

<script>
function openWin()
{
window.open("includes/barCode.php?unid=<?php echo $row_barcode['unid'] . '&f1=' . $row_barcode['f1'] . '&f2=' . $row_barcode['f2'] . '&f3=' . $row_barcode['f3'] . '&f4=' . $row_barcode['f4'] . '&f5=' . $row_barcode['f5'] . '&f6=' . $row_barcode['f6'] . '&f7=' . $row_barcode['f7']; ?>","_blank","toolbar=no, scrollbars=no, resizable=yes, top=20, left=20, width=400, height=400");
}
 <!-- openWin(); -->



</script>
    
<?php 
}
?>

<div class="row">
<div class="col-sm-12">
<h3>Add to Shelf</h3>
<hr />
</div>
</div>




<div class="row" >
	<div class="col-md-6"></div>
	<div class="col-md-6">
		<p>Scan Shelf</p>
		<hr />
		<form action="add_to_shelf_step_2.php" method="post">
<table width="100%" border="0">

  <tr style="height: 35px;">
    <td>Shelf UnId:</td>
    <td><?php echo generateTextAuto($main_table . '_shelf_unid');  ?><td>
  </tr>

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
	<th>UnId</th>
    <th>Barcode</th>
	<th>Type</th>
    <th>Make</th> 
    <th>Model</th> 
    <th>Serial</th> 
    <th>Shelf UnId</th> 
    <th>Shelf Name</th> 


    <th style="text-align: center;">EDIT</th>

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
 


    <td style="text-align: center;"><a href="add_to_shelf_step_2.php?edit_listing_unid=<?php echo $row['prod_unid'] ?>" class="btn btn-large btn-info msgbox-confirm" ><i class="glyphicon glyphicon-list"></i></a></td>
     
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