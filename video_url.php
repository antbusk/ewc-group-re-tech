<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
$vid_id = $_GET['unid'];



$object_image_file = 'gs://ewc-group-re-tech.appspot.com/videos/' . $vid_id . '.mp4';
$object_image_url = CloudStorageTools::getPublicUrl($object_image_file);

header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.
header('Location:' . $object_image_url);

?>