<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
require("db_info.php");
        if (!function_exists('curl_init')) {
            require_once 'includes/curl/Purl.php';
        }
require_once('pubhub/Pubnub.php');
$prod_unid = $_GET['unid'];
$user_id = $_GET['user'];
$url = $_GET['url'];
$query = "INSERT INTO videos (prod_unid) VALUES ('$prod_unid')";
	$result1 = mysql_query($query);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
$vid_name = mysql_insert_id();
file_put_contents('gs://ewc-group-re-tech.appspot.com/videos/' . $vid_name . '.mp4', fopen($url, 'r'));

error_reporting(-1);

$publish_key   = isset($argv[1]) ? $argv[1] : 'pub-c-ba03836b-fdac-4c7e-9f67-26dd653c237b';
$subscribe_key = isset($argv[2]) ? $argv[2] : 'sub-c-584817da-98d1-11e3-8d39-02ee2ddab7fe';
$secret_key    = isset($argv[3]) ? $argv[3] : 'sec-c-OWZkODFiMDItNThmNC00NmQzLWI5OGItMzQ2NTQzZGIxYWM1';
$cipher_key	   = isset($argv[4]) ? $argv[4] : false;
$ssl_on        = false;
$pubnub = new Pubnub( $publish_key, $subscribe_key, $secret_key, $cipher_key, $ssl_on );

$publish_success = $pubnub->publish(array(
    'channel' => 'vid_done_' . $user_id,
    'message' => array(
	'state' => 'load',
	'prod_unid' => $prod_unid
	)
));

?>