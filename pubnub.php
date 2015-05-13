<?php
        if (!function_exists('curl_init')) {
            require_once 'includes/curl/Purl.php';
        }

error_reporting(-1);
require_once('pubhub/Pubnub.php');
$publish_key   = isset($argv[1]) ? $argv[1] : 'pub-c-ba03836b-fdac-4c7e-9f67-26dd653c237b';
$subscribe_key = isset($argv[2]) ? $argv[2] : 'sub-c-584817da-98d1-11e3-8d39-02ee2ddab7fe';
$secret_key    = isset($argv[3]) ? $argv[3] : 'sec-c-OWZkODFiMDItNThmNC00NmQzLWI5OGItMzQ2NTQzZGIxYWM1';
$cipher_key	   = isset($argv[4]) ? $argv[4] : false;
$ssl_on        = false;
$pubnub = new Pubnub( $publish_key, $subscribe_key, $secret_key, $cipher_key, $ssl_on );

$publish_success = $pubnub->publish(array(
    'channel' => 'test',
    'message' => array(
	'state' => 'print',
	'timestamp' => 'print',
	'unid' => '23',
	'sku' => '55',
	'f1' => 'print',
	'f2' => 'print',
	'f3' => 'print',
	'f4' => 'print',
	'f5' => 'print',
	'f6' => 'print',
	'f7' => 'print',
	'f8' => 'print'
	)
));
print_r($publish_success);
?>