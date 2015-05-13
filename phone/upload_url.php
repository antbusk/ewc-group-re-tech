<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
	

$prod_unid = $_GET['prod_unid'];
$user_id = $_GET['user_unid'];
$options = [ 'gs_bucket_name' => 'ewc-group-re-tech.appspot.com' ];
$upload_url = CloudStorageTools::createUploadUrl('/phone/upload_handler.php?unid=' . $prod_unid . '&user=' . $user_id, $options);

echo json_encode(array("upload_url" => $upload_url, "unid" => $prod_unid));

?>