<?php
require('login_check.php');
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
require_once('sales_channal_api/ebay/keys.php'); 
require_once('sales_channal_api/ebay/eBaySession.php');


echo $header;	


	if(isset($_POST['unid']))
	{
$product_unid = $_POST['unid'];

	$query_barcode = "SELECT *, products.unid AS unid, product_types.unid AS cat_unid
	FROM products
	INNER JOIN (product_types) ON (product_types.unid=products.f1) 
	WHERE products.sub_unid = '$account_bridge' AND products.unid = '$product_unid'";
$result_barcode = mysql_query($query_barcode);
if (!$result_barcode) {
  die('Invalid query: ' . mysql_error());
}
$row_barcode = mysql_fetch_assoc($result_barcode);
$title_t = $row_barcode['f2'] . ' ' . $row_barcode['f3'] . ' ' . $row_barcode['f7'];
$itemTitle  = substr($title_t,0,80);






	$query1 = "INSERT INTO listings (sub_unid) VALUES ('$account_bridge')";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
	}
// done

$listing_id = mysql_insert_id();








	$query2 = "INSERT INTO product_to_listings ( sub_unid, f1, f2) VALUES ('$account_bridge', '$listing_id', '$product_unid')";
$result2 = mysql_query($query2);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
}
  
  
  
  
	$query_products = "SELECT *, 
	product_to_listings.unid AS unid, 
	products.unid AS prod_unid, 
	products.f1 AS prodf1, 
	products.f2 AS prodf2, 
	products.f3 AS prodf3, 
	products.f4 AS prodf4, 
	products.f5 as prodf5, 
	products.f6 AS prodf6, 
	products.f7 AS prodf7, 
	products.f8 AS prodf8, 
	products.f9 AS prodf9, 
	products.f10 AS prodf10, 
	listings.unid AS list_unid, 
	listings.f1 AS listf1, 
	product_types.unid AS cat_unid 
		FROM product_to_listings 
			INNER JOIN (listings) ON (listings.unid=product_to_listings.f1) 
			INNER JOIN (products) ON (products.unid=product_to_listings.f2) 
			INNER JOIN (product_types) ON (product_types.unid=products.f1) 
				WHERE products.sub_unid = '$account_bridge' AND product_to_listings.f1 = '$listing_id' 
					ORDER BY products.unid DESC";
					
					
$result_products = mysql_query($query_products);
if (!$result_products) {
  die('Invalid query: ' . mysql_error());
}
/// end list of listings
$count1 = mysql_num_rows($result);
	


	
	
	
$query_photos = "SELECT * FROM photos WHERE prod_unid = '$product_unid' ORDER BY `order` ASC";

$result_photos = mysql_query($query_photos);
if (!$result_photos) {
  die('Invalid query: ' . mysql_error());
	}

	
	
	
	
	
ob_start();
?>
<div id="ds_div"><font color="#ad001f">&nbsp;</font><table align="center" style="border-spacing: 0px; width: 1280px;"><tbody><tr><td><div id="ds_div"><table align="center" style="border-spacing: 0px; width: 1278px;"><tbody><tr><td><div id="ds_div"><table align="center" style="border-spacing: 0px; width: 1276px;"><tbody><tr><td><div id="ds_div"><div><font size="5" color="#ad001f"></font></div><div><font size="5" color="#ad001f"></font></div><div><br></div><div><div id="ds_div"><table align="center" style="border-spacing: 0px; width: 1276px;"><tbody><tr><td><div id="ds_div"><div><font size="7" color="#002cfd"><b>This is an AS-IS Lot, all units are being sold for parts or repair.&nbsp;</b></font></div><div><font color="#ff0010" size="7"><b>==================================</b></font></div>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 


<table id="myTable" class="table table-condensed table-hover" > 
<thead> 
<tr class="border_bottom2"> 
	<th><b>Listing Id</b></th>
    <th><b>Product Id</b></th>
    <th><b>Type</b></th> 
    <th><b>Make</b></th> 
    <th><b>Model</b></th>
	<th><b>P/N</b></th>
    <th><b>Serial</b></th>
    <th><b>Asset Tag</b></th>
	<th><b>Piece Count</b></th>
	<th><b>Gross</b></th>
    <th><b>Tare</b></th>
	<th><b>Net</b></th>
    <th><b>Notes</b></th>
</tr> 
</thead> 
<tbody> 
<?php 
while($row = mysql_fetch_assoc($result_products)){ ?>
<tr class="border_bottom">
<?php 
$net_weight = $row['prodf6'] - $row['prodf8']; ?>
	<td><?php echo $row['list_unid']; ?></td>
	<td><?php echo $row['prod_unid']; ?></td>
	<td><?php echo $row['f1']; ?></td>
    <td><?php echo $row['prodf2']; ?></td> 
    <td><?php echo $row['prodf3']; ?></td>
	<td><?php echo $row['prodf10']; ?></td>
    <td><?php echo $row['prodf4']; ?></td> 
    <td><?php echo $row['prodf5']; ?></td>
	<td><?php echo $row['prodf9']; ?></td>
	<td><?php echo $row['prodf6']; ?></td>
    <td><?php echo $row['prodf8']; ?></td>
	<td><?php echo $net_weight; ?></td>
    <td><?php echo $row['prodf7']; ?></td>
    

<?php $total_weight = $total_weight + $row['prodf6']; 
$total_net_weight = $total_net_weight + $net_weight;
$total_tare = $total_tare + $row['prodf8'];
$total_quantity = $total_quantity + $row['prodf9']; 

?> 

 
</tr> 
<?php } ?>
</tbody>
</table>




</table>
<table id="myTable" class="table table-condensed table-hover"> 
<thead> 

<tr class="border_bottom">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
    <td></td> 
	<td></td>
	<td></td>
	<td>Total Piece Count:</td>
	<td><?php echo $total_quantity ?></td>

	<td colspan="2">Gross Weight:</td>
    <td><?php echo $total_weight; ?></td>
	<td></td>
</tr>
<tr class="border_bottom">

	<td></td>
	<td></td>
    <td></td> 
    <td></td>
	<td></td>
    <td></td>
	<td></td>
	<td></td>
	<td></td>
	<td colspan="2">Tare Weight:</td>
    <td><?php echo $total_tare; ?></td>
	<td></td>
</tr>
<tr>
	<td></td>
	<td></td>
    <td></td>
    <td></td>
    <td></td>  
	<td></td>
	<td></td>
	<td></td>
	<td></td>

	<td colspan="2">Net Weight:</td>
    <td><?php echo $total_net_weight; ?></td>
	<td></td>
</tr>
</tbody>
</table>





&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
<table id="myTable" class="table table-condensed table-hover"><thead><tr class="border_bottom2"><th><br></th></tr></thead></table></div></td><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th><th><br></th></tr></tbody><tbody></tbody></table></div></div></div></td></tr></tbody></table><div><br></div><div><font color="#ff0010" size="7"><b>=================================</b></font></div><div><br></div></div><div><font color="#ff0010" size="7"><b>AS-IS PARTS OR REPAIR</b></font></div><div><br></div><div><div><font size="5" color="#f30094"></font></div><div><font size="5" color="#f30094"></font></div></div><div><font size="5"><br></font></div><div><font size="5"><br></font></div><div><font color="#08d6f7" size="5"><b><br></b></font></div><div><font color="#08d6f7" size="5"><b><br></b></font></div><div><br></div></td></tr></tbody></table></div></td></tr></tbody></table>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<table width="700" height="148"  border="0" align="center"><tbody><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255); text-align: center;">AS-IS</th><th width="342" bgcolor="#6786EB" style="color: rgb(255, 255, 255); text-align: center;">Warranty</th></tr><tr><td width="348" height="100">Item is as described and should match the description accurately, item has no warranty or implied support towards the product &nbsp;or its described and/or Unknown conditions.The buyer is purchasing an item in whatever condition it presently exists,the buyer is accepting the item "with all faults", whether or not immediately apparent to the seller or buyer. Each Item is inspected for as much detail towards the workings and known repairs that are possible. Additionally we are open to bargaining prices.</td><td>If A warranty is described or listed for a product,we will be providing on going support for a limited number of days not exceeding more than 30. &nbsp;Procedures include the repairr or similar items may be &nbsp;delivered and/or refunds may be rewarded if no suitable part or replacement is available and or no longer cost &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; effective. All decisions regarding the type of warranty procedure will be under the sole discretion of the seller.</td></tr></tbody></table>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<table width="600"  border="0" align="center"><tbody><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255); text-align: center;">SHIPPING AND PACKING OF ITEMS</th></tr><tr><td width="600">All of our items are packed with great attention to detail, each product will be boxed as if it were one of a kind regardless of the price or condition. If your item/items are damaged during transport we must be notified as soon as possible. We Do NOT ship outside of the U.S.A which is limited to the North American Continent. Packages are shipped within 3 buisness days following the full Payment of the Auctioned Amount, This does not count Weekends. We Do Not Refund Shipping and Handeling Charges unless already negotioated to do so.</td></tr></tbody></table>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<table width="417"  border="0" align="center"><tbody><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255); text-align: center;">IS IT COMPATIBLE, WILL IT WORK?</th></tr><tr><td width="200">If buying an item that can not be tested often times this is an archaic device or would have excessive testing requirements and time frames, or an item with limited supported hardware available, it is recommended that you are well skilled in this items repair and/or operation. Such as &nbsp;a unique PCI card, Diagnostic devices, Items that require repair, Items sold for parts.</td></tr></tbody></table>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<div><br></div><div><table width="331"  border="0" align="center"><tbody><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255); text-align: center;">Gold Scrap/Precious Metals Lots</th></tr><tr><td width="100">All Lots are weighed to the best of our ability, The TARE is listed as box is taped to hold structure and typically a bag. Contents are than Added and weighed with the TARE from the BOX's First weigh in. TARE can be rounded up or down &nbsp;up to 1-4 ounces depending on scales however it is only typical to have 0.5 to 0.9 ounce Differences as most scales round up and down automatically. Boxes are than taped shut and or have packing material added, this weight is not calculated or added into the auctions listing details.The Box TARE will likely be slightly &nbsp;different after contents are removed, as extra tape has not been calculated after packing, however most scales round this up or down as described automatically.&nbsp;</td></tr></tbody></table></div><div>&nbsp;<table width="331"  border="0" align="center"><tbody><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255); text-align: center;">WASHINGTON STATE RESIDENTS</th></tr><tr><td width="100">If you are a resident of Washington State, we are required to charge you state tax at 0.095%</td></tr></tbody></table><p>&nbsp;</p>&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;<table align="center" border="1" cellspacing="0" cellpadding="0" bgcolor="#99CCCC"><tbody><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255); font-size: 18px;"><strong>HOURS Of Operation</strong></th><th bgcolor="#6786EB" style="color: rgb(255, 255, 255); font-size: 18px;"><strong>Days Available</strong></th></tr><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255);"><strong>10AM PST - 4PM PST</strong></th><th bgcolor="#6786EB" style="color: rgb(255, 255, 255);"><strong>Monday Through Friday</strong></th></tr><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255);"><strong>HOLIDAYS</strong></th><th bgcolor="#6786EB" style="color: rgb(255, 255, 255);"><strong>WEEKENDS</strong></th></tr><tr><th bgcolor="#6786EB" style="color: rgb(255, 255, 255);"><strong>CLOSED</strong></th><th bgcolor="#6786EB" style="color: rgb(255, 255, 255);">CLOSED</th></tr></tbody></table><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p style="text-align: center;"><a href="http://vi.vipr.ebaydesc.com/ws/www.paypal.com"><img border="0" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_SbyPP_mc_vs_dc_ae.jpg" alt="paypal" width="350" height="130" align="middle"></a></p>&nbsp;</div></div>
<?php
$itemDescription = ob_get_clean();






 
        	
		//SiteID must also be set in the Request's XML
		//SiteID = 0  (US) - UK = 3, Canada = 2, Australia = 15, ....
		//SiteID Indicates the eBay site to associate the call with
		$siteID = 0;
		//the call being made:
		$verb = 'AddItem';
		
		///Build the request Xml string
		$requestXmlBody  = '<?xml version="1.0" encoding="utf-8" ?>';
		$requestXmlBody .= '<AddItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">';
		$requestXmlBody .= "<RequesterCredentials><eBayAuthToken>$userToken</eBayAuthToken></RequesterCredentials>";
		$requestXmlBody .= '<DetailLevel>ReturnAll</DetailLevel>';
		$requestXmlBody .= '<ErrorLanguage>en_US</ErrorLanguage>';
		$requestXmlBody .= "<Version>$compatabilityLevel</Version>";
		$requestXmlBody .= '<Item>';
		$requestXmlBody .= '<Site>US</Site>';
		
		
		$requestXmlBody .= '<PrimaryCategory>';
		$requestXmlBody .= "<CategoryID>177</CategoryID>";
		$requestXmlBody .= '</PrimaryCategory>';
		
		$requestXmlBody .= "<ConditionID>7000</ConditionID>";
		
		$requestXmlBody .= "<BuyItNowPrice currencyID=\"USD\">0.0</BuyItNowPrice>";
		
		$requestXmlBody .= '<Country>US</Country>';
		$requestXmlBody .= '<Currency>USD</Currency>';
		
		$requestXmlBody .= "<ListingDuration>Days_7</ListingDuration>";
        $requestXmlBody .= "<ListingType>Chinese</ListingType>";
		
		$requestXmlBody .= '<Location><![CDATA[Auburn, WA]]></Location>';
		$requestXmlBody .= '<PaymentMethods>PayPal</PaymentMethods>';
		$requestXmlBody .= "<PayPalEmailAddress>$paypal</PayPalEmailAddress>";
		
		
		$requestXmlBody .= "<PictureDetails>";
		while($row_photos = mysql_fetch_assoc($result_photos))
			
		{ 
		$pic_id = $row_photos['unid'];
$object_image_file = 'gs://ewc-group-re-tech.appspot.com/photos/' . $pic_id . '.jpg';
$object_image_url = CloudStorageTools::getImageServingUrl($object_image_file,
                                            ['size' => 0, 'crop' => false]);
		$requestXmlBody .= "<PictureURL>$object_image_url</PictureURL>";
		}
		$requestXmlBody .= "</PictureDetails>";
		

		
		
		
		
		$requestXmlBody .= '<ReturnPolicy> ';
 		$requestXmlBody .= '<ReturnsAcceptedOption>ReturnsNotAccepted</ReturnsAcceptedOption>';
 		$requestXmlBody .= '</ReturnPolicy>';
 		
		$requestXmlBody .= '<ShippingDetails>'; 
 		$requestXmlBody .= '<ShippingServiceOptions>'; 
 		$requestXmlBody .= '<ShippingServicePriority>1</ShippingServicePriority>'; 
 		$requestXmlBody .= '<ShippingService>UPSGround</ShippingService>'; 
 		$requestXmlBody .= '<ShippingServiceCost>0.00</ShippingServiceCost>'; 
 		$requestXmlBody .= '<ShippingServiceAdditionalCost>0.00</ShippingServiceAdditionalCost>'; 
 		$requestXmlBody .= '</ShippingServiceOptions>'; 
 		$requestXmlBody .= '</ShippingDetails>';
		
		
		$requestXmlBody .= '<DispatchTimeMax>3</DispatchTimeMax>';
		$itemDescription2 = utf8_encode($itemDescription);
		$requestXmlBody .= "<Quantity>1</Quantity>";
		$requestXmlBody .= "<StartPrice>29.99</StartPrice>";
		$requestXmlBody .= '<ShippingTermsInDescription>True</ShippingTermsInDescription>';
		$requestXmlBody .= "<Title><![CDATA[$itemTitle]]></Title>";
		$requestXmlBody .= "<Description><![CDATA[$itemDescription2]]></Description>";
		$requestXmlBody .= '</Item>';
		$requestXmlBody .= '</AddItemRequest>';

		

		
		
        //Create a new eBay session with all details pulled in from included keys.php
        $session = new eBaySession($userToken, $devID, $appID, $certID, $serverUrl, $compatabilityLevel, $siteID, $verb);
		
		//send the request and get response
		$responseXml = $session->sendHttpRequest($requestXmlBody);
		if(stristr($responseXml, 'HTTP 404') || $responseXml == '')
			die('<P>Error sending request');
		
		//Xml string is parsed and creates a DOM Document object
		$responseDoc = new DomDocument();
		$responseDoc->loadXML($responseXml);
		
			
		//get any error nodes
		$errors = $responseDoc->getElementsByTagName('Errors');
		
		//if there are error nodes
		if($errors->length > 0)
		{
			echo '<P><B>eBay returned the following error(s):</B>';
			//display each error
			//Get error code, ShortMesaage and LongMessage
			$code     = $errors->item(0)->getElementsByTagName('ErrorCode');
			$shortMsg = $errors->item(0)->getElementsByTagName('ShortMessage');
			$longMsg  = $errors->item(0)->getElementsByTagName('LongMessage');
			//Display code and shortmessage
			echo '<P>', $code->item(0)->nodeValue, ' : ', str_replace(">", "&gt;", str_replace("<", "&lt;", $shortMsg->item(0)->nodeValue));
			//if there is a long message (ie ErrorLevel=1), display it
			if(count($longMsg) > 0)
				echo '<BR>', str_replace(">", "&gt;", str_replace("<", "&lt;", $longMsg->item(0)->nodeValue));
	
		} else { //no errors
            
			//get results nodes
            $responses = $responseDoc->getElementsByTagName("AddItemResponse");
            foreach ($responses as $response) {
              $acks = $response->getElementsByTagName("Ack");
              $ack   = $acks->item(0)->nodeValue;
              echo "Ack = $ack <BR />\n";   // Success if successful
              
              $endTimes  = $response->getElementsByTagName("EndTime");
              $endTime   = $endTimes->item(0)->nodeValue;
              echo "endTime = $endTime <BR />\n";
              
              $itemIDs  = $response->getElementsByTagName("ItemID");
              $itemID   = $itemIDs->item(0)->nodeValue;
              echo "itemID = $itemID <BR />\n";
              
              $linkBase = "http://cgi.sandbox.ebay.com/ws/eBayISAPI.dll?ViewItem&item=";
              echo "<a href=$linkBase" . $itemID . ">$itemTitle</a> <BR />";
              
              $feeNodes = $responseDoc->getElementsByTagName('Fee');
              foreach($feeNodes as $feeNode) {
                $feeNames = $feeNode->getElementsByTagName("Name");
                if ($feeNames->item(0)) {
                    $feeName = $feeNames->item(0)->nodeValue;
                    $fees = $feeNode->getElementsByTagName('Fee');  // get Fee amount nested in Fee
                    $fee = $fees->item(0)->nodeValue;
                    if ($fee > 0.0) {
                        if ($feeName == 'ListingFee') {
                          printf("<B>$feeName : %.2f </B><BR>\n", $fee); 
                        } else {
                          printf("$feeName : %.2f <BR>\n", $fee);
                        }      
                    }  // if $fee > 0
                } // if feeName
              } // foreach $feeNode
            
            } // foreach response
            
		} // if $errors->length > 0























	}


?>

<div id="product_form" >
<div class="row">
<div class="col-sm-12">
<h3>Photos</h3>
<hr />
</div>
</div>
<div class="row">
<div class="col-sm-6">
</div>
<div class="col-sm-6">
			<p>Scan Sku</p>
		<hr />
		<form id="form_sku" action="ebay_laptop_list.php" method="post">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>Product Id:</td>
    <td><?php echo generateTextAuto('unid', '', 'false');  ?><td>
  </tr>
  <tr style="height: 35px;">

  <tr>
    <td><button class="btn btn-large" type="submit"  name="submit" value="submit">Submit</button></td>
    <td></td>
  </tr>
</table>
</div>
</div>
</div>	
<?php	

echo $footer;
?>