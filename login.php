<?php
require("db_info.php");
$success = '';
$error = '';


// Inialize session

$form_username = '';
$form_password = '';

if(isset($_POST['submit'])) {
    
$form_username = mysql_real_escape_string($_POST['username']);
$form_password = mysql_real_escape_string($_POST['password']);
     
    
    $form_password = md5($form_password);

// Retrieve username and password from database according to user's input
$login = mysql_query("SELECT * FROM home_users WHERE (f3 = '" . $form_username . "') and (f4 = '" . $form_password . "')");

// Check username and password match
if (mysql_num_rows($login) == 1) {
// Set username cookie variable
setcookie("username", $_POST['username'], time()+28800);
$rand_password = rand();
$rand_password = md5($rand_password);
setcookie("rand_password", $rand_password, time()+28800);
$id = $_POST['username'];
date_default_timezone_set('America/Chicago'); // CDT
$session_login_date_time = date('d/m/Y == H:i:s');
$ipaddress = $_SERVER["REMOTE_ADDR"];


// update db
$query = "UPDATE home_users SET session = '" . $rand_password . "' WHERE f3 = '" . $id . "' ";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
	}
// done



 
// Jump to secured page
header('Location: products.php');
}
else {
// Jump to login page
$error = '<div class="alert alert-danger">Oh Snap!! Wrong Username or Password</div>';
}
}
?>
<!DOCTYPE html>
<html>
  <head>

    <title>Login - EWC Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/bootstrap_3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/bootstrap_3/css/custom/signin.css" rel="stylesheet">


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/bootstrap_3/js/jquery-1.10.2.min.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <STYLE TYPE="text/css"> 
#body {
	background-color: #444444; 
	color: white;
}
#headerlogo {

	height: 87px;

	margin-right: -8px;
	margin-left: -8px;
}
</STYLE>
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
          <a class="navbar-brand" href="#">EWC Group - Re Tech</a>
        </div>
        <div class="navbar-collapse collapse">                  
          <ul class="nav navbar-nav navbar-right">

    </ul>
        </div><!--/.nav-collapse -->
      </div>





    <div class="container">
      <form class="form-signin" action="login.php" method="POST">
      <?php echo $success; ?>
      <?php echo $error; ?>
        <h2 class="form-signin-heading">Please sign in</h2>

<table style="width: 400px;">


	<td>Username</td>
	<td><input type="text" class="form-control" name="username" placeholder="Username" required autofocus></td>
</tr>
	<td>Password</td>
	<td><input type="password" name="password" class="form-control" placeholder="Password" required></td>
</tr>
<tr>
	<td></td>
	<td><button class="btn btn-lg btn-primary btn-block"  name="submit" value="submit" type="submit">Sign in</button></td>
</tr>
</table>

    </form>

    </div> <!-- /container -->







    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/bootstrap_3/js/jquery-1.10.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap_3/js/bootstrap.min.js"></script>
    

    
    
    
  </body>
</html>
<?php 



?>