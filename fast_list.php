<?php
error_reporting(E_ALL);
require("login_check.php");
$main_table = 'products';
$error = '';
$row_listing['f1'] = '';
$row_listing['f3'] = '';
$row_listing['f11'] = '';
$row_listing['f14'] = '';



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
$f3 =  mysql_real_escape_string($_POST[$main_table . '_f3']);
$f11 =  mysql_real_escape_string($_POST[$main_table . '_f11']);
$f14 =  mysql_real_escape_string($_POST[$main_table . '_f14']);


if ($insert_or_edit == 'insert') {    // insert beggin
// Select all the rows in the markers table
$sku_match = mysql_query("SELECT * FROM sku WHERE sf14 = '$f14'");

if (mysql_num_rows($sku_match) == 1) {
	
	
	
	
	$query_sku_unid = "SELECT unid, sf1, sf3, sf11, sf14 FROM sku WHERE sf14 = '$f14'";
$result_sku_unid = mysql_query($query_sku_unid);
if (!$result_sku_unid) { die('Invalid query: ' . mysql_error()); }
$row_sku_unid = mysql_fetch_assoc($result_sku_unid);
	$sku_unid = $row_sku_unid['unid'];
	$f1 = $row_sku_unid['sf1'];
	$f3 = $row_sku_unid['sf3'];
	$f11 = $row_sku_unid['sf11'];
	$f14 = $row_sku_unid['sf14'];
$_SESSION['last_sku_unid'] = $sku_unid;
if($product_page == 'sub_product'){	
			$query1 = "INSERT INTO $main_table 
			(sub_unid, client_id, sub_prod, sku_unid, instock, f1, f3, f9, f11, f14) VALUES 
			('$account_bridge', '$client', '$sub_product', '$sku_unid', '1', '$f1', '$f3', '1', '$f11', '$f14' )";
	} else if ($product_page == 'client'){
			$query1 = "INSERT INTO $main_table 
			(sub_unid, client_id, sku_unid, instock, f1, f3, f9, f11, f14) VALUES 
			('$account_bridge', '$client', '$sku_unid', '1', '$f1', '$f3', '1', '$f11', '$f14' )";
	} else {
			$query1 = "INSERT INTO $main_table 
			(sub_unid, sku_unid, instock, f1, f3, f9, f11, f14) VALUES 
			('$account_bridge', '$sku_unid', '1', '$f1', '$f3', '1', '$f11', '$f14' )";		
		}
	$result1 = mysql_query($query1);
	if (!$result1) {
	die('Invalid query right here: ' . mysql_error()); }
	$_SESSION['last_insert']= mysql_insert_id();
$query_listing_sum = "SELECT sum(f9) AS total_quanity FROM $main_table WHERE sku_unid = '$sku_unid' AND instock = '1'";
$result_listing_sum = mysql_query($query_listing_sum);
if (!$result_listing_sum) { die('Invalid query: ' . mysql_error()); }
$row_listing_sum = mysql_fetch_assoc($result_listing_sum);
$num_sku_quanity = $row_listing_sum['total_quanity'];

	$query_sku = "UPDATE sku SET sf9='$num_sku_quanity' WHERE unid = '$sku_unid'";
		$result_sku = mysql_query($query_sku);
if (!$result_sku) {
  die('Invalid query1222: ' . mysql_error());	}
 
	
	
	
	
	
	
	
	

} else {
	// insert into db
	$query_sku = "INSERT INTO sku (sub_unid, sf1, sf3, sf11, sf14) VALUES ('$account_bridge', '$f1', '$f3', '$f11', '$f14')";
		$result_sku = mysql_query($query_sku);
if (!$result_sku) {
  die('Invalid query: ' . mysql_error());
}
$sku_unid = mysql_insert_id();
$_SESSION['last_sku_unid'] = $sku_unid;




if($product_page == 'sub_product'){	
			$query1 = "INSERT INTO $main_table 
			(sub_unid, client_id, sub_prod, sku_unid, instock, f1, f3, f9, f11, f14) VALUES 
			('$account_bridge', '$client', '$sub_product', '$sku_unid', '1', '$f1', '$f3', '1', '$f11', '$f14' )";
	} else if ($product_page == 'client'){
			$query1 = "INSERT INTO $main_table 
			(sub_unid, client_id, sku_unid, instock, f1, f3, f9, f11, f14) VALUES 
			('$account_bridge', '$client', '$sku_unid', '1', '$f1', '$f3', '1', '$f11', '$f14' )";
	} else {
			$query1 = "INSERT INTO $main_table 
			(sub_unid, sku_unid, instock, f1, f3, f9, f11, f14) VALUES 
			('$account_bridge', '$sku_unid', '1', '$f1', '$f3', '1', '$f11', '$f14' )";		
		}
		
	$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query1111: ' . mysql_error());
	}
// done

$_SESSION['last_insert']= mysql_insert_id();
	 }
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
		$query4 = "SELECT *, $main_table.unid AS unid, product_types.unid AS cat_unid, sku.unid AS sku_unid
	FROM $main_table 
	INNER JOIN (product_types)
              ON (product_types.unid=$main_table.f1) INNER JOIN (sku) ON (sku.unid=$main_table.sku_unid) 
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
	"sku":"<?php echo  $_SESSION['last_sku_unid']; ?>",
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

<p id='last_sku_unid'><?php if(isset($_SESSION['last_sku_unid'])) { echo $_SESSION['last_sku_unid']; } ?></p>
<a class="btn btn-default" id='sku_unid_button' href="#" role="button">Copy To Clipboard</a>

<script>
$(document).ready(function(){
$('a#sku_unid_button').zclip({
path:'bootstrap_3/js/ZeroClipboard.swf',
copy:$('p#last_sku_unid').text()
});
</script>


	</div>
	<div class="col-md-6">
		<p>Add Product</p>
		<hr />
		<form  action="fast_list.php" method="post" >
<table width="100%" border="0">
  <tr style="height: 35px;">
    <td>UPC:</td>
    <td><?php echo generateTextAuto($main_table . '_f11', $row_listing['f11'], 'true');  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Title:</td>
    <td><?php echo generateText($main_table . '_f3', $row_listing['f3']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>ASIN:</td>
    <td><?php echo generateText($main_table . '_f14', $row_listing['f14'], 'true');  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Product Type:</td>
    <td><?php echo generateSelect($main_table . '_f1', $array_listing_cat, $row_listing['f1']);  ?><td>
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
	<th>SKU</th>
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
	<td><?php echo $row['sku_unid']; ?></td>
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