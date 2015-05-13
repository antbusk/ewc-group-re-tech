<?php
require('login_check.php');
$main_table = 'products';
$error = '';
$row_listing['f1'] = '';
$row_listing['f2'] = '';
$row_listing['f3'] = '';
$row_listing['f4'] = '';
$row_listing['f5'] = '';
$row_listing['f6'] = '';
$row_listing['f7'] = '';
$row_listing['f8'] = '0';
$row_listing['f9'] = '1';
$row_listing['f10'] = '';
$product_page = '';
if(isset($_GET['client'])) {
	$_SESSION['client'] = $_GET['client'];
	$_SESSION['product_page'] = 'client';
	$client = $_GET['client'];
	$product_page = "client";

} 
if (isset($_GET['sub_product'])){
	$_SESSION['sub_product'] = $_GET['sub_product'];
	$_SESSION['product_page'] = 'sub_product';
	$product_page = "sub_product";
	$sub_product = $_GET['sub_product'];
} 
if (!isset($_GET['client']) && !isset($_GET['sub_product'])){
	if(isset($_SESSION['product_page'])) {
	$product_page = $_SESSION['product_page'];}
	if(isset($_SESSION['sub_product'])) {
	$sub_product = $_SESSION['sub_product'];}
	if(isset($_SESSION['client'])) {
	$client = $_SESSION['client'];}
}
if(isset($_GET['done'])){
if ($_GET['done'] == "sub_product"){
	$sub_product = '';
	$_SESSION['product_page'] = '';
	$_SESSION['product_page'] = 'client';
	$product_page = "client";
} else if ($_GET['done'] == 'client') {
	$_SESSION['client'] = '';
	$product_page = "";
}
}
if($product_page == 'client') {
		$clear_page = 'client';
	$clear_button = 'Done with client';
} else if ($product_page == 'sub_product') {
		$clear_page = 'sub_product';
	$clear_button = 'Done with sub product';
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
$f8 =  mysql_real_escape_string($_POST[$main_table . '_f8']);
$f9 =  mysql_real_escape_string($_POST[$main_table . '_f9']);
$f10 =  mysql_real_escape_string($_POST[$main_table . '_f10']);


if ($insert_or_edit == 'insert') {    // insert beggin

	// insert into db
	if($product_page == 'sub_product'){
		$query1 = "INSERT INTO $main_table (  sub_unid, client_id, sub_prod, f1, f2, f3, f4, f5, f6, f7, f8, f9, f10) VALUES ( '$account_bridge', '$client', '$sub_product', '$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9', '$f10')";
	} else if ($product_page == 'client'){
	$query1 = "INSERT INTO $main_table (  sub_unid, client_id, f1, f2, f3, f4, f5, f6, f7, f8, f9, f10) VALUES ( '$account_bridge', '$client', '$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9', '$f10')";
	}
	else {
			$query1 = "INSERT INTO $main_table (  sub_unid, f1, f2, f3, f4, f5, f6, f7, f8, f9, f10) VALUES ('$account_bridge', '$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9', '$f10')";

	}
	$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done

$_SESSION['last_insert']= mysql_insert_id();

}   // insert end
 
 
 
 
if ($insert_or_edit == 'edit'){    // edit begin

// update db
$query = "UPDATE $main_table SET f1='$f1', f2='$f2', f3='$f3', f4='$f4', f5='$f5', f6='$f6', f7='$f7', f8='$f8', f9='$f9', f10='$f10'  WHERE unid = '$submit_edit_listing_unid' AND sub_unid = '$account_bridge' ";
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
	
	
/// get list of listings	
if($product_page == 'sub_product'){
	$query4 = "SELECT *, $main_table.unid AS unid, product_types.unid AS cat_unid 
	FROM $main_table 
	INNER JOIN (product_types)
                 ON (product_types.unid=$main_table.f1) 
						WHERE $main_table.sub_unid = '$account_bridge' AND $main_table.sub_prod = '$sub_product' ORDER BY products.unid DESC LIMIT 0, 20";
}
if($product_page == 'client'){
	$query4 = "SELECT *, $main_table.unid AS unid, product_types.unid AS cat_unid 
	FROM $main_table 
	INNER JOIN (product_types)
                 ON (product_types.unid=$main_table.f1) 
						WHERE $main_table.sub_unid = '$account_bridge' AND $main_table.client_id = '$client' ORDER BY products.unid DESC LIMIT 0, 20";
}
if ($product_page == '') {
		$query4 = "SELECT *, $main_table.unid AS unid, product_types.unid AS cat_unid 
	FROM $main_table 
	INNER JOIN (product_types)
                 ON (product_types.unid=$main_table.f1) 
						WHERE $main_table.sub_unid = '$account_bridge' ORDER BY products.unid DESC LIMIT 0, 20";

	
}
						
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
	$query_barcode = "SELECT *, $main_table.unid AS unid, product_types.unid AS cat_unid
	FROM $main_table 
	INNER JOIN (product_types) ON (product_types.unid=$main_table.f1) 
	WHERE $main_table.sub_unid = '$account_bridge' AND $main_table.unid = '$lastid'";
$result_barcode = mysql_query($query_barcode);
if (!$result_barcode) {
  die('Invalid query: ' . mysql_error());
}

$row_barcode = mysql_fetch_assoc($result_barcode);
?>

<script>
function openWin()
{
	function printPDF(){

pubnub.publish({
    channel: '<?php echo $user_unid ?>',
    message: {
	"state":"print",
	"unid":"<?php echo  $row_barcode['unid']; ?>",
	"timestamp":"<?php echo  $row_barcode['timestamp']; ?>",  
	"sku":"<?php echo  $row_barcode['sku_unid']; ?>",
	"f1":"<?php echo  $row_barcode['f1']; ?>",
	"f2":"<?php echo  $row_barcode['f2']; ?>",
	"f3":"<?php echo  $row_barcode['f3']; ?>",
	"f4":"<?php echo  $row_barcode['f4']; ?>",
	"f5":"<?php echo  $row_barcode['f5']; ?>",
	"f6":"<?php echo  $row_barcode['f6']; ?>",
	"f7":"<?php echo  $row_barcode['f7']; ?>",
	"f8":"<?php echo  $row_barcode['f8']; ?>"

	}
 });
}
//var url = "http://ewc-group-re-tech.appspot.com/includes/barCode.php?timestamp=<?php echo $row_barcode['timestamp']; ?>&unid=<?php echo $row_barcode['unid'] . '&f1=' . $row_barcode['f1'] . '&f2=' . $row_barcode['f2'] . '&f3=' . $row_barcode['f3'] . '&f4=' . $row_barcode['f4'] . '&f5=' . $row_barcode['f5'] . '&f6=' . $row_barcode['f6'] . '&f7=' . $row_barcode['f7']; ?>";
printPDF();
//window.open("http://ewc-group-re-tech.appspot.com/includes/barCode.php?timestamp=<?php echo $row_barcode['timestamp']; ?>&unid=<?php echo $row_barcode['unid'] . '&f1=' . $row_barcode['f1'] . '&f2=' . $row_barcode['f2'] . '&f3=' . $row_barcode['f3'] . '&f4=' . $row_barcode['f4'] . '&f5=' . $row_barcode['f5'] . '&f6=' . $row_barcode['f6'] . '&f7=' . $row_barcode['f7']; ?>","_blank","toolbar=no, scrollbars=no, resizable=yes, top=20, left=20, width=400, height=400");
}
openWin();



</script>
    
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
				<p>Scan Product</p>
		<hr />
		<form action="products.php" method="get">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>Product Id:</td>
    <td><?php echo generateText('edit_listing_unid', '', '');  ?><td>
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
<p></p>
<?php if (isset($clear_page)){ ?>
	<a class="btn btn-default" href="products.php?done=<?php echo $clear_page; ?>" role="button"><?php echo $clear_button; ?></a>
<?php
	}
?>
	</div>
	<div class="col-md-6">
		<p>Add Product</p>
		<hr />
		<form  action="<?php echo $main_table; ?>.php" method="post" >
<table width="100%" border="0">
  <tr style="height: 35px;">
    <td>Product Type:</td>
    <td><?php echo generateSelect($main_table . '_f1', $array_listing_cat, $row_listing['f1']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Make:</td>
    <td><?php echo generateText($main_table . '_f2', $row_listing['f2']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Model:</td>
    <td><?php echo generateText($main_table . '_f3', $row_listing['f3'], 'true');  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>P/N:</td>
    <td><?php echo generateText($main_table . '_f10', $row_listing['f10'], 'true');  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Serial:</td>
    <td><?php echo generateText($main_table . '_f4', $row_listing['f4'], 'true');  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Asset Tag:</td>
    <td><?php echo generateText($main_table . '_f5', $row_listing['f5'], 'true');  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Piece Count:</td>
    <td><?php echo generateText($main_table . '_f9', $row_listing['f9']);  ?><td>
  </tr>
    <tr style="height: 35px;">
    <td>Tare:</td>
    <td><?php echo generateText($main_table . '_f8', $row_listing['f8']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Gross Weight:</td>
    <td><?php echo generateText($main_table . '_f6', $row_listing['f6']);  ?><td>
  </tr>
    <tr style="height: 35px;">
    <td>Notes:</td>
    <td><?php echo generateText($main_table . '_f7', $row_listing['f7']);  ?><td>
  </tr>
  <tr>
    <td><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></td>
    <td></td>
  </tr>
</table>



<!-- begin form footer -->
<?php if(isset($_GET['edit_listing_unid'])) { echo '<input type="hidden" name="submit_edit_listing_unid" value="' . $_GET['edit_listing_unid']. '" />'; }  
if (isset($client_id)){echo '<input type="hidden" name="client_id" value="' . $client_id. '" />';} 
?>

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
	<th>Type</th>
    <th>Make</th> 
    <th>Model</th> 
    <th>Serial</th> 
    <th>Asset Tag</th>
	<th>Piece Count</th>
	<th>Gross</th>	
    <th>Tare</th>
    <th style="text-align: center;">PRINT</th>
    <th style="text-align: center;">EDIT</th>
    <th style="text-align: center;">DELETE</th> 
</tr> 
</thead> 
<tbody> 
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
<tr>
	<td><a href="products.php?sub_product=<?php echo $row['unid']; ?>"><?php echo $row['unid']; ?></a></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['f2']; ?></td> 
    <td><?php echo $row['f3']; ?></td> 
    <td><?php echo $row['f4']; ?></td> 
    <td><?php echo $row['f5']; ?></td>
	<td><?php echo $row['f9']; ?></td>
	<td><?php echo $row['f6']; ?></td> 
    <td><?php echo $row['f8']; ?></td> 

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