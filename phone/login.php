<?php
header("access-control-allow-origin: *"); 
require("db_info.php");
$success = '';
$error = '';


// Inialize session

$form_username = '';
$form_password = '';

if(isset($_POST['username'])) {
    
$form_username = mysql_real_escape_string($_POST['username']);
$form_password = mysql_real_escape_string($_POST['password']);
     
    
    $form_password = md5($form_password);

// Retrieve username and password from database according to user's input
$login = mysql_query("SELECT * FROM home_users WHERE (f3 = '" . $form_username . "') and (f4 = '" . $form_password . "')");

// Check username and password match
if (mysql_num_rows($login) == 1) {
	$query_user = "SELECT * FROM home_users WHERE f3 = '" . $form_username . "' ";
  
$query_result = mysql_query($query_user);
if (!$query_result) {
  die('Invalid user query: ' . mysql_error());
}

$user = mysql_fetch_array($query_result);




$user_unid = $user['unid'];

 echo json_encode(array("login" => "true", "unid" => $user_unid));
// Jump to secured page

}
else {
// Jump to login page

 echo json_encode(array("login" => "false"));


}
}
?>