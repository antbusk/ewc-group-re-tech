<?php
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
$pic_id = $_GET['unid'];
$size = $_GET['size'];


$object_image_file = 'gs://ewc-group-re-tech.appspot.com/photos/' . $pic_id . '.jpg';
$object_image_url = CloudStorageTools::getImageServingUrl($object_image_file,
                                           ['size' => (int)$size, 'crop' => false]);

header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.
header('Location:' . $object_image_url);

?>