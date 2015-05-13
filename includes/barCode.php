<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EWC Group - Re Tech</title>


</head>
<body id="content">
<?php 

$unid = $_GET['unid'];
$f1 = $_GET['f1']; 
$f2 = $_GET['f2']; 
$f3 = $_GET['f3']; 
$f4 = $_GET['f4']; 
$f5 = $_GET['f5'];
$f6 = $_GET['f6'];           
$f7 = $_GET['f7'];           
$timestamp = $_GET['timestamp']; 

?>
</head>
<body id="content" >


<div align="center"><img alt="barcode" src="http://ewc-group-re-tech.appspot.com/includes/barcode_img.php?text=<?php echo $unid; ?>&size=50" /></div>
<?php



$TimeStr= $timestamp;
$TimeZoneNameFrom="UTC";
$TimeZoneNameTo="America/Los_Angeles";
echo date_create($TimeStr, new DateTimeZone($TimeZoneNameFrom))
        ->setTimezone(new DateTimeZone($TimeZoneNameTo))->format("m-d-Y g:i A");





?>


<table cellspacing="0" cellpadding="0">
  <col width="75">
  <col width="64">
  <tr>
    <td width="75" style="font-size: 24px">UnId:</td>
    <td width="263" style="font-size: 24px"><?php echo $unid; ?></td>
  </tr>
  <tr>
    <td style="font-size: 24px">Serial:</td>
    <td style="font-size: 24px"><?php echo $f4 ?></td>
  </tr>
</table>

<table cellspacing="0" cellpadding="0">
  <col width="75">
  <col width="84">
  <col width="64">
  <col width="146">
  <tr>
    <td width="92">Type:</td>
    <td colspan="3" style="font-size: 24px"><b><?php echo $f1; ?></b></td>

  </tr>
  <tr>
    <td>Make:</td>
    <td><?php echo $f2; ?></td>
    <td></td>
    <td></td>
  </tr>
    <tr>
    <td  >Model:</td>
    <td colspan="3" ><?php echo $f3; ?></td>

  </tr>
  <tr>
    <td>Asset Tag:</td>
    <td><?php echo $f5; ?></td>
    <td>Weight:</td>
    <td><?php echo $f6; ?></td>
  </tr>
</table>
<p><?php echo $f7; ?></p>

</body>
</html>