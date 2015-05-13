<?php
require("db_info.php");
$success = '';
$error = '';












$user1 = mysql_real_escape_string($_COOKIE['username']);
$password1 = mysql_real_escape_string($_COOKIE["rand_password"]);

// Inialize session
session_start();

$login = mysql_query("SELECT * FROM home_users WHERE (f3 = '" . $user1 . "') and (session = '" . $password1 . "')");

if (mysql_num_rows($login) == 1) {
    
    
$query_user = "SELECT * FROM home_users WHERE f3 = '" . $user1 . "' ";
    

$query_result = mysql_query($query_user);
if (!$query_result) {
  die('Invalid user query: ' . mysql_error());
}

$user = mysql_fetch_array($query_result);




$user_unid = $user['unid'];
$account_bridge = $user['sub_unid'];

    $rand_password = rand();
	$rand_password = md5($rand_password);

setcookie("rand_password", $rand_password, time()+28800);
date_default_timezone_set('America/Chicago'); // CDT
$session_login_date_time = date('d/m/Y == H:i:s');
$ipaddress = $_SERVER["REMOTE_ADDR"];


// update db
$query = "UPDATE home_users SET session = '" . $rand_password . "' WHERE f3 = '" . $user1 . "' ";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
	}
// done

ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EWC Group - Re Tech</title>
<style type="text/css">
#body {
	background-color: #444444; 
	color: white;
}
#page {
	position: relative;	
}
.table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
  background-color: #5c5c5c !important;
  color:#eeeeee !important;
}
#56 {
	width:120px;
	margin-bottom:10px;
}

.navbar .brand {
max-height: 40px;
overflow: visible;
padding-top: 0;
padding-bottom: 0;
}
.navbar a.navbar-brand {padding: 6px 15px 8px; }
</style>


		
		
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../bootstrap_3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../bootstrap_3/js/jquery-1.10.2.min.js"></script>
	<script src="../bootstrap_3/js/copyToclipBoard.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link href="../bootstrap_3/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<?php if(isset($redirect)) {
	if($redirect == true){
echo '<meta http-equiv="refresh" content="0; url=' . $redirect_url . '" />';
} }?>
<!-- Include the PubNub Library -->
<script src="https://cdn.pubnub.com/pubnub.min.js"></script>
 <?php  if(isset($movie_record)) {
	if($movie_record == true){ ?>
		

		<script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
		<script language="JavaScript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<!-- Please download the JW Player plugin from http://www.longtailvideo.com/jw-player/download -->
		<script src="http://jwpsrv.com/library/AS9U1u3kEeSaGQp+lcGdIw.js"></script>

		<script language="JavaScript" src="ScriptCam-master/static/scriptcam.js"></script>
		<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<?php } } ?>
<!-- Instantiate PubNub -->
<script type="text/javascript">
var pubnub = PUBNUB.init({
publish_key: 'pub-c-ba03836b-fdac-4c7e-9f67-26dd653c237b',
subscribe_key: 'sub-c-584817da-98d1-11e3-8d39-02ee2ddab7fe'
});
</script>
<script>
function getNextElement(field) {
    var form = field.form;
    for ( var e = 0; e < form.elements.length; e++) {
        if (field == form.elements[e]) {
            break;
        }
    }
    return form.elements[++e % form.elements.length];
}

function tabOnEnter(field, evt) {
if (evt.keyCode === 13) {
        if (evt.preventDefault) {
            evt.preventDefault();
        } else if (evt.stopPropagation) {
            evt.stopPropagation();
        } else {
            evt.returnValue = false;
        }
        getNextElement(field).focus();
        return false;
    } else {
        return true;
    }
}
</script>
  
	  

</head>
<body id="body">

      <!-- Static navbar -->
      <div style="margin: 20px;" class="navbar navbar-default">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

		  <a class="navbar-brand" href="#"><img src="includes/images/logo.png" alt=""></a>
        </div>
        <div class="navbar-collapse collapse">                  
          <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged in as <?php echo '' . $user['f1'] . ' ' . $user['f2'] . ''; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="logout.php">Logout</a></li>
          <li><a href="#">Change Profile</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
        </div><!--/.nav-collapse -->
      </div>
<div id="page">
<div class="row"><!-- row 1 div oppening tag -->
<div class="col-sm-1">
</div>
<div class="col-sm-2">
<ul class="nav nav-list">
  <li class="nav-header">Left Menue</li>
  <li><a href="user.php">Users</a></li>
  <li><a href="user.php">Franchise</a></li>
  <li><a href="clients.php">Clients</a></li>
  <hr />
  <li><a href="scheduled_pickups.php">Scheduled Pickups</a></li>
  <hr />
  <li><a href="search_products.php">Search Products</a></li>
  <li><a href="sku_search.php">Search SKU</a></li>
  <li><a href="products.php">Products</a></li>
  <li><a href="photos.php">Photos</a></li>
  <li><a href="cell_photos.php">Cell Photos</a></li>
  <li><a href="add_to_shelf.php">Add to Shelf</a></li>
  <li><a href="quality_control.php">Quality Control</a></li>
  <li><a href="listings.php">Add to Listing</a></li>
  <li><a href="fast_list.php">Fast List</a></li>
  <hr />
  <li><a href="outgoing.php">Outgoing</a></li>
  <hr />
  <li><a href="shelf.php">Shelf's</a></li>
  <li><a href="product_types.php">Product Categories</a></li>
  <hr />
  <li><a href="hdd_testing.php">Hard Drive Testing</a></li>
  <li><a href="hdd_videos.php">Hard Drive Shreding</a></li>
  <li><a href="http://storage.googleapis.com/ewc-group-re-tech.appspot.com/qz-printing/printer_2.html?printer=<?php echo $user_unid ?>" target="_blank" >Print Page</a></li>
  <li><a href="http://storage.googleapis.com/ewc-group-re-tech.appspot.com/qz-printing/printer_2.html?printer=hdd_printer_1" target="_blank" >HDD Print Page</a></li>
  <hr />
  <li><a href="website_categories.php">Website Categories</a></li>
  <li><a href="ebay_laptop_list.php">ebay_list</a></li>
  <li><a href="ebay_other_list.php">ebay_other_list</a></li>
  <li><a href="ebay_game_list.php">ebay_game_list</a></li>
  
  <hr />
  ......
</ul>
</div>
<div class="col-sm-8"><!-- contents div aoppening tag -->

<?php
	    echo $success;
      echo $error;
$header = ob_get_clean();






ob_start();
?>
</div><!-- contents div clossing tag -->
<div class="col-sm-1">
</div>
</div><!-- row 1 div clossing tag -->
</div><!-- page div clossing tag -->
<script src="../bootstrap_3/js/bootstrap.min.js"></script>
<script src="../bootstrap_3/js/bootstrap-datetimepicker.min.js"></script>
</body>
</html>
<?php
$footer = ob_get_clean();





ob_start();
?>





<?php
$sidebar = ob_get_clean();


ob_start();
?>

<?php
$javascript_includes = ob_get_clean();

   function generateSelect($name = '', $options = array(),  $default = '1') {
$html = '<select class="form-control input-sm" id="'.$name.'" name="'.$name.'">';

foreach ($options as $option => $value ) {
    if ($value['unid'] == $default) {
        $html .= '<option value="'.$value['unid'].'" selected="selected">'.$value['f1'].'</option>';
    } else {
        $html .= '<option value="'.$value['unid'].'">'.$value['f1'].'</option>';
    }
}

$html .= '</select>';
return $html;
}

function generateText($name, $value, $tab = '0'){
if ($tab == 'true') {
$tab_code = 'onkeydown="return tabOnEnter(this,event)"';}


	?>
	<input class="form-control input-sm" <?php echo $tab_code; ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" type="text" />
	<?php
}
function generateTextAuto($name, $value, $tab){
if ($tab == 'true') {
$tab_code = 'onkeydown="return tabOnEnter(this,event)"';}else{$tab_code = ''; }

	?>
	<input class="form-control input-sm" <?php echo $tab_code; ?> id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" type="text" autofocus />
	<?php
}
function generateTextRead($name, $value){
	?>
	<input class="form-control input-sm" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" type="text" readonly />
	<?php
}

function generateTextArea($name, $value){
	?>
	<textarea class="form-control input-sm" id="<?php echo $name; ?>" name="<?php echo $name; ?>" rows="50" cols="50" ><?php echo $value; ?></textarea>
	<?php
}




function generateDateText($name, $value){
	?>
 <script type="text/javascript">
  $(function() {
    $('#<?php echo $name; ?>_div').datetimepicker({
      pickTime: false
    });
  });
</script>
	<div id="<?php echo $name; ?>_div" class="input-append">
    <input id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>"  data-format="yyyy-MM-dd" type="text"></input>
    <span class="add-on"><i class="glyphicon glyphicon-list-alt"></i></span>
    </div>
	<?php
}
function generateTimeText($name, $value){
	?>
    <script type="text/javascript">
  $(function() {
    $('#<?php echo $name; ?>_div').datetimepicker({
      pickDate: false,
      pick12HourFormat: true
    });
  });
</script>
	<div id="<?php echo $name; ?>_div" class="input-append">
    <input id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>"  data-format="hh:mm:ss" type="text"></input>
    <span class="add-on"><i class="glyphicon glyphicon-list-alt"></i></span>
    </div>
	<?php
}
   function tableMatch($options = array(),  $default = '') {
$default = $default - 1;
foreach ($options as $option => $value ) {
    if ($option == $default) {
        $html = $value['f1'];
    }
}
return $html;
}


  function getCord($address){
  	$xml = simplexml_load_file('http://maps.googleapis.com/maps/api/geocode/xml?address=' . $address . '&sensor=false');
$lat = $xml->result->geometry->location->lat;
$lng = $xml->result->geometry->location->lng;
	
	$cord = array();
	$cord['lat'] = $lat; 
	$cord['lon'] = $lng; 
	return  $cord;
  	
 }  
    
function getMileage($orgin, $dest){
	$orgin = urlencode($orgin);
	$dest = urlencode($dest);
    $google_maps_url = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $orgin . "&destinations=" . $dest . "&mode=bicycling&language=en-FR&units=imperial&sensor=false");
    $google_maps_array = json_decode(utf8_encode($google_maps_url),true);
    $milage = $google_maps_array['rows'][0]['elements'][0]['distance']['text'];

return $milage;
}

    
} else { header('Location: login.php'); }


?>