<?php 
$unid = $_GET['unid'];
$f1 = $_GET['f1']; 
        
?>
<div align="center"><img alt="barcode" width='300px' height='50px' src="barcode_img.php?text=<?php echo $unid; ?>&size=50&code_length=100" /></div>


<table cellspacing="0" cellpadding="0">
  <col width="75">
  <col width="64">
  <tr>
    <td width="75" style="font-size: 24px">UnId:</td>
    <td width="263" style="font-size: 24px"><?php echo $unid; ?></td>
	
  </tr>
  <tr>
    <td style="font-size: 24px">Shelf:</td>
    <td style="font-size: 24px"><?php echo $f1 ?></td>
  </tr>
</table>


