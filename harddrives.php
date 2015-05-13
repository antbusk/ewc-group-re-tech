<?php
require("db_info.php");
        if (!function_exists('curl_init')) {
            require_once 'includes/curl/Purl.php';
        }

error_reporting(-1);
require_once('pubhub/Pubnub.php');
$account_bridge = 1;
$pass_fail = '';
$model =  mysql_real_escape_string($_GET['f1']);
$serial =  mysql_real_escape_string($_GET['f2']);
$firmware =  mysql_real_escape_string($_GET['f3']);
$size =  mysql_real_escape_string($_GET['f4']);
$cache =  mysql_real_escape_string($_GET['f5']);
$type =  mysql_real_escape_string($_GET['f6']);
$timestamp =  mysql_real_escape_string($_GET['f7']);
$part_unm = '';
$timestamp_stop = '';

$hard_drive_sku_exists = mysql_query("SELECT *,
sku.unid as sku_unid,
product_9.unid as att_unid
 FROM sku
INNER JOIN (product_9) ON (product_9.sku_unid=sku.unid)
 WHERE sku.sf1 = '9' AND sku.sf3 = '$model' AND product_9.firmware = '$firmware'");
$hard_drive_exists = mysql_query("SELECT * FROM products WHERE f1 = '9' AND f4 = '$serial'");
$sku_exists = mysql_num_rows($hard_drive_sku_exists);
$harddrive_exists = mysql_num_rows($hard_drive_exists);

if($harddrive_exists == 1){

$query1 = "UPDATE products SET f17='$pass_fail' WHERE f1 = '9' AND f4 = '$serial'";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done

} elseif ($sku_exists == 1) {
	
$query2 = "SELECT sku_unid,
sku.unid as sku_unid,
product_9.unid as att_unid
 FROM sku
INNER JOIN (product_9) ON (product_9.sku_unid=sku.unid)
 WHERE sku.sf1 = '9' AND sku.sf3 = '$model' AND product_9.firmware = '$firmware'";
$result2 = mysql_query($query2);
if (!$result2) {
  die('Invalid query: ' . mysql_error());
	}
// done
$end2 = mysql_fetch_assoc($result2);
$sku_unid = $end2['sku_unid'];

$query3 = "INSERT INTO products 
			(sub_unid, sku_unid, instock, f1, f3, f4, f10, f15, f16, f17) VALUES 
			('$account_bridge', '$sku_unid', '1', '9', '$model', '$serial', '$part_num', '$timestamp', '$timestamp_stop', '$pass_fail' )";
			
$result3 = mysql_query($query3);
if (!$result3) {
  die('Invalid query: ' . mysql_error());
	}
// done			
$prod_unid = mysql_insert_id();

} else {
	$query4 = "INSERT INTO sku (sf1, sf3, sf9) VALUES ('9', '$model', '1' )";
	$result4 = mysql_query($query4);
if (!$result4) {
  die('Invalid queryjjj: ' . mysql_error());
}
  $sku_unid = mysql_insert_id();
  
	$query7 = "INSERT INTO product_9 (sku_unid, firmware, size, cache, type) VALUES ('$sku_unid', '$firmware', '$size', '$cache', '$type' )";
	$result7 = mysql_query($query7);
if (!$result7) {
  die('Invalid queryjjj: ' . mysql_error());
	}
// done	

$query5 = "INSERT INTO products 
			(sub_unid, sku_unid, instock, f1, f3, f4, f10, f15, f16, f17) VALUES 
			('$account_bridge', '$sku_unid', '1', '9', '$model', '$serial', '$part_num', '$timestamp_start', '$timestamp_stop', '$pass_fail' )";
			
	$result5 = mysql_query($query5);
if (!$result5) {
  die('Invalid query: ' . mysql_error());
	}
// done				
	$prod_unid = mysql_insert_id();
}

	$query_barcode = "SELECT *, products.unid AS unid, product_types.unid AS cat_unid
	FROM products 
	INNER JOIN (product_types) ON (product_types.unid=products.f1) 
	WHERE products.unid = '$prod_unid'";
$result_barcode = mysql_query($query_barcode);
if (!$result_barcode) {
  die('Invalid query: ' . mysql_error());
}

$row_barcode = mysql_fetch_assoc($result_barcode);



$publish_key   = isset($argv[1]) ? $argv[1] : 'pub-c-ba03836b-fdac-4c7e-9f67-26dd653c237b';
$subscribe_key = isset($argv[2]) ? $argv[2] : 'sub-c-584817da-98d1-11e3-8d39-02ee2ddab7fe';
$secret_key    = isset($argv[3]) ? $argv[3] : 'sec-c-OWZkODFiMDItNThmNC00NmQzLWI5OGItMzQ2NTQzZGIxYWM1';
$cipher_key	   = isset($argv[4]) ? $argv[4] : false;
$ssl_on        = false;
$pubnub = new Pubnub( $publish_key, $subscribe_key, $secret_key, $cipher_key, $ssl_on );

$publish_success = $pubnub->publish(array(
    'channel' => 'hdd_printer_1',
    'message' => array(
	'state' => 'print',
	'timestamp' => $row_barcode['timestamp'],
	'unid' => $row_barcode['unid'],
	'sku' => $row_barcode['sku_unid'],
	'f1' => $row_barcode['f1'],
	'f2' => $row_barcode['f2'],
	'f3' => $row_barcode['f3'],
	'f4' => $row_barcode['f4'],
	'f5' => $row_barcode['f5'],
	'f6' => $row_barcode['f6'],
	'f7' => $row_barcode['f7'],
	'f8' => $row_barcode['f8']
	)
));
?>