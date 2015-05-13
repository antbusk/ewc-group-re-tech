<?php
require("login_check.php");
$main_table = 'clients';
$error = '';
$row_listing['f1'] = '';
$row_listing['f2'] = '';
$row_listing['f3'] = '';
$row_listing['f4'] = '';
$row_listing['f5'] = '';
$row_listing['f6'] = '';
$row_listing['f7'] = '';
$row_listing['f8'] = '';
$row_listing['f9'] = '';

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


if ($insert_or_edit == 'insert') {    // insert begin

	// insert into db
	$query1 = "INSERT INTO $main_table (f1, f2, f3, f4, f5, f6, f7, f8, f9) VALUES ('$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9')";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done

$_SESSION['last_insert']= mysql_insert_id();

}   // insert end
 
 
 
 
if ($insert_or_edit == 'edit'){    // edit begin

// update db
$query = "UPDATE $main_table SET f1='$f1', f2='$f2', f3='$f3', f4='$f4', f5='$f5', f6='$f6', f7='$f7', f8='$f8', f9='$f9'  WHERE unid = '$submit_edit_listing_unid'";
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
		$query5 = "DELETE FROM $main_table WHERE unid = '$unid'";
$result5 = mysql_query($query5);
if (!$result5) {
  die('Invalid query: ' . mysql_error());
}	
} // end delete listing 
	
	///// get listing info
if(isset($_GET['edit_listing_unid'])) {
 
// Select all the rows in the markers table
$query_listing = "SELECT * FROM $main_table WHERE unid = '$edit_listing_unid'";
$result_listing = mysql_query($query_listing);
if (!$result_listing) {
  die('Invalid query: ' . mysql_error());
}
$row_listing = mysql_fetch_assoc($result_listing);

} // end get listing info
	
	
/// get list of listings	
	$query4 = "SELECT * FROM $main_table";
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



	



</script>
    
<?php 
}
?>

<div class="row">
<div class="col-sm-12">
<h3>Clients</h3>
<hr />
</div>
</div>




<div class="row" >
	<div class="col-md-6"></div>
	<div class="col-md-6">
		<p>Add Client</p>
		<hr />
		<form action="<?php echo $main_table; ?>.php" method="post">
<table width="100%" border="0">
  <tr style="height: 35px;">
    <td>Business Name:</td>
    <td><?php echo generateText($main_table . '_f1', $row_listing['f1']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Address Line 1:</td>
    <td><?php echo generateText($main_table . '_f2', $row_listing['f2']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Address Line 2:</td>
    <td><?php echo generateText($main_table . '_f3', $row_listing['f3']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>City:</td>
    <td><?php echo generateText($main_table . '_f4', $row_listing['f4']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>State:</td>
    <td><?php echo generateText($main_table . '_f5', $row_listing['f5']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Zip:</td>
    <td><?php echo generateText($main_table . '_f6', $row_listing['f6']);  ?><td>
  </tr>
    <tr style="height: 35px;">
    <td>Phone:</td>
    <td><?php echo generateText($main_table . '_f7', $row_listing['f7']);  ?><td>
  </tr>
  <tr style="height: 35px;">
    <td>Fax:</td>
    <td><?php echo generateText($main_table . '_f8', $row_listing['f8']);  ?><td>
  </tr>
    <tr style="height: 35px;">
    <td>E-Mail:</td>
    <td><?php echo generateText($main_table . '_f9', $row_listing['f9']);  ?><td>
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
    <th>Business Name</th>
	<th>Address Line 1</th>
    <th>Address Line 2</th> 
    <th>City</th> 
    <th>State</th> 
    <th>Zip</th>
	<th>Phone</th>

    <th style="text-align: center;">EDIT</th>
    <th style="text-align: center;">DELETE</th> 
</tr> 
</thead> 
<tbody> 
<?php while ($row = @mysql_fetch_assoc($result)){ ?>
<tr>
	<td><a href="products.php?client=<?php echo $row['unid']; ?>"><?php echo $row['unid']; ?></a></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['f2']; ?></td> 
    <td><?php echo $row['f3']; ?></td> 
    <td><?php echo $row['f4']; ?></td> 
    <td><?php echo $row['f5']; ?></td>
	<td><?php echo $row['f6']; ?></td>
	<td><?php echo $row['f7']; ?></td> 



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