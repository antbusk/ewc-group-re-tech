<?php
require("db_info.php");
$success = '';
$error = '';


if(isset($_POST['submit'])) {
$f1 =  mysql_real_escape_string($_POST['first_name']);
$f2 =  mysql_real_escape_string($_POST['last_name']);
$f3 =  mysql_real_escape_string($_POST['username']);
$f4 =  mysql_real_escape_string($_POST['password']);
$f5 =  mysql_real_escape_string($_POST['retypepassword']);

// Select all the rows in the markers table
$query1 = "SELECT * FROM home_users WHERE f3 = '$f3'";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
}

$num_rows = mysql_num_rows($result1);

if(isset($_POST['submit'])) {
if ($num_rows >= '1' ) {
	$error = '<div class="alert alert-danger">Oh Snap!! Duplicate Username</div>'; 
	} else if ($f4 != $f5) {
	$error = '<div class="alert alert-danger">Oh Snap!! Passwords Did Not Match</div>';
	} else {
	$f4 = md5($f4);
	$query2 = "INSERT INTO home_users (sub_unid, permission, f1, f2, f3, f4) VALUES ('3', '1', '$f1', '$f2', '$f3', '$f4')";
$result2 = mysql_query($query2);
if (!$result2) {
  die('Invalid query: ' . mysql_error());
	}
// done

	$success = '<div class="alert alert-success">You Created an account, please sign in.</div>';



 }  }
}
?>
<!DOCTYPE html>
<html>
  <head>

    <title>Register - EWC Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap_3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap_3/css/custom/signin.css" rel="stylesheet">


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap_3/js/jquery-1.10.2.min.js"></script>


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
      <form class="form-signin" action="register.php" method="POST">
      <?php echo $success; ?>
      <?php echo $error; ?>
        <h2 class="form-signin-heading">Please sign up</h2>

<table style="width: 400px;">

<tr>
	<td>First Name</td>
	<td><input type="text" class="form-control" name="first_name" placeholder="First Name" required ></td>
</tr>

<tr>
	<td>Last Name</td>
	<td><input type="text" class="form-control" name="last_name" placeholder="Last  Name" required ></td>
</tr>
<tr>




	<td>Username</td>
	<td><input type="text" class="form-control" name="username" placeholder="Username" required ></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" name="password" class="form-control" placeholder="Password" required></td>
</tr>
<tr>
	<td>Retype Password</td>
	<td><input type="password" name="retypepassword" class="form-control" placeholder="Password" required></td>
</tr>
<tr>
	<td></td>
	<td><button class="btn btn-lg btn-primary btn-block"  name="submit" value="submit" type="submit">Sign up</button></td>
</tr>
</table>

    </form>

    </div> <!-- /container -->










    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="bootstrap_3/js/jquery-1.10.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap_3/js/bootstrap.min.js"></script>
    

    
    
    
  </body>
</html>