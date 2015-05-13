<?php
require("../login_check.php");
if(isset($_GET['cat_unid'])){
	
$cat_unid = mysql_real_escape_string($_GET['cat_unid']);
$_SESSION['att_cat_unid'] = $cat_unid;
$_SESSION['att_cat_unid'] = 'product_' . $cat_unid;
//check to see if catagorie table exists
$cat_table = 'product_' . $cat_unid;
if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '$cat_table'"))==1){ 
 //table exists
} else { 
// Table does not exist
// create table
	mysql_query("CREATE TABLE $cat_table(
unid INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(unid), 
 prod_unid INT,
 sku_unid INT
 )
 ")
 or die(mysql_error());  
}

} else {$cat_table = $_SESSION['att_cat_unid'];
}






$main_table = 'product_attributes';
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
	
$f1 =  mysql_real_escape_string($_POST[$main_table . '_f1']);








/////insert colom into database///////////////////////////////////////////////////////////////////////////////////////////
if ($insert_or_edit == 'insert') {    // insert beggin
//	if($f2 == '1'){$f2 = 'VARCHAR(50)';} else if ($f2 == '2') {$f2 = 'INT(11)';}

	
	// insert into db
	$query1 = "INSERT INTO product_attributes ( sub_unid, f1) VALUES ('$account_bridge', '$f1')";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done
$col_num = mysql_insert_id();

$_SESSION['last_insert'] = $col_num;

	$queryAddCol = "ALTER TABLE $cat_table ADD '$col_num' VARCHAR(50) LAST;";
	$resultAddCol = mysql_query($queryAddCol);
if (!$resultAddCol) {
  die('Invalid query: ' . mysql_error());
	}
// done
}   // insert end
 
 
 





 
if ($insert_or_edit == 'edit'){    // edit begin

// update db
$query = "UPDATE product_attributes SET f1='$f1' WHERE unid = '$submit_edit_listing_unid' AND sub_unid = '$account_bridge'";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
	}
// done


} // edit end
 
}// emd submit post

// delete listing
if (isset($_GET['delete_listing'])) {
			$queryDelCol = "ALTER TABLE $cat_table DROP COLUMN '$unid'";
$resultDelCol = mysql_query($queryDelCol);
if (!$resultDelCol) {
  die('Invalid query: ' . mysql_error());
}	
	
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
	
	
/// get list of listings	
	$query4 = "SELECT * FROM $main_table WHERE sub_unid = '$account_bridge' ORDER BY unid DESC";
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
	$query_barcode = "SELECT * FROM $main_table WHERE $main_table.sub_unid = '$account_bridge' AND $main_table.unid = '$lastid'";
$result_barcode = mysql_query($query_barcode);
if (!$result_barcode) {
  die('Invalid query: ' . mysql_error());
}

$row_barcode = mysql_fetch_assoc($result_barcode);
?>

<script>
function openWin()
{
window.open("includes/shelfBarCode.php?unid=<?php echo $row_barcode['unid'] . '&f1=' . $row_barcode['f1']; ?>","_blank","toolbar=no, scrollbars=no, resizable=yes, top=20, left=20, width=400, height=400");
}
openWin();



</script>
    
<?php 
}
?>

<div class="row">
<div class="col-sm-12">
<h3>Product Attributes</h3>
<hr />
</div>
</div>




<div class="row" >
	<div class="col-md-6"></div>
	<div class="col-md-6">
		<p>Add Type</p>
		<hr />
		<form action="product_attributes/<?php echo $main_table; ?>.php" method="post">
<table width="100%" border="0">

  <tr style="height: 35px;">
    <td>Name:</td>
    <td><?php echo generateText($main_table . '_f1', $row_listing['f1']);  ?><td>
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
	<th>Name</th>

    <th style="text-align: center;">PRINT</th>
    <th style="text-align: center;">EDIT</th>
    <th style="text-align: center;">DELETE</th> 
</tr> 
</thead> 
<tbody> 
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
<tr>
	<td><?php echo $row['unid']; ?></td>
	<td><?php echo $row['f1']; ?></td>
 

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