<?php
require('login_check.php');
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
require_once('sales_channal_api/ebay/keys.php'); 
require_once('sales_channal_api/ebay/eBaySession.php');


echo $header;	


	if(isset($_POST['unid']))
	{
$product_unid = mysql_real_escape_string($_POST['unid']);
$price = mysql_real_escape_string($_POST['price']);
$ship = mysql_real_escape_string($_POST['ship']);
$desc = mysql_real_escape_string($_POST['desc']);
$condition = mysql_real_escape_string($_POST['condition']);

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
$cat_id = $row_barcode['ebay_cat'];





	$query1 = "INSERT INTO listings (sub_unid, f9, f10, f11, f12, f13) VALUES ('$account_bridge', '$desc', '$price', '$ship', '$condition', '$cat_id')";
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
	


	
	
	
$query_photos = "SELECT * FROM photos WHERE prod_unid = '$product_unid'";

$result_photos = mysql_query($query_photos);
if (!$result_photos) {
  die('Invalid query: ' . mysql_error());
	}

	
	
	
	
	
ob_start();
?>
<font face="Arial" size="6"><?php echo $desc; ?></font>
<br><br>
<br><br>
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
		$requestXmlBody .= "<CategoryID>$cat_id</CategoryID>";
		$requestXmlBody .= '</PrimaryCategory>';
		
		$requestXmlBody .= "<ConditionID>$condition</ConditionID>";
		
		$requestXmlBody .= "<BuyItNowPrice currencyID=\"USD\">0.0</BuyItNowPrice>";
		
		
		
		
		
		/// Do Not Edit
		$requestXmlBody .= '<Country>US</Country>';
		$requestXmlBody .= '<Currency>USD</Currency>';
		$requestXmlBody .= "<ListingDuration>Days_7</ListingDuration>";
        $requestXmlBody .= "<ListingType>Chinese</ListingType>";
		$requestXmlBody .= '<Location><![CDATA[Tukwila, WA]]></Location>';
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
		

		
		
		
		//Return Policy
		$requestXmlBody .= '<ReturnPolicy> ';
 		$requestXmlBody .= '<ReturnsAcceptedOption>ReturnsNotAccepted</ReturnsAcceptedOption>';
 		$requestXmlBody .= '</ReturnPolicy>';
 		
		
		//free shipping
		$requestXmlBody .= '<ShippingDetails>'; 
 		$requestXmlBody .= '<ShippingServiceOptions>'; 
 		$requestXmlBody .= '<ShippingServicePriority>1</ShippingServicePriority>'; 
 		$requestXmlBody .= '<ShippingService>UPSGround</ShippingService>'; 
 		$requestXmlBody .= "<ShippingServiceCost>$ship</ShippingServiceCost>"; 
 		$requestXmlBody .= '<ShippingServiceAdditionalCost>0.00</ShippingServiceAdditionalCost>'; 
 		$requestXmlBody .= '</ShippingServiceOptions>'; 
 		$requestXmlBody .= '</ShippingDetails>';
		
		// Frieght shipping
		//$requestXmlBody .= '<ShippingDetails>';
		//$requestXmlBody .= '<ShippingServiceOptions>';
		//$requestXmlBody .= '<ShippingService>Freight</ShippingService>';
		//$requestXmlBody .= '</ShippingServiceOptions>';
		//$requestXmlBody .= '<ShippingType>FreightFlat</ShippingType>';
		//$requestXmlBody .= '</ShippingDetails>';
		
		// Box Size
		$requestXmlBody .= '<PackageDepth unit="in" measurementSystem="English">3</PackageDepth>';
		$requestXmlBody .= '<PackageLength unit="in" measurementSystem="English">8</PackageLength>';
		$requestXmlBody .= '<PackageWidth unit="in" measurementSystem="English">8</PackageWidth>';
		
		// Weight
		$requestXmlBody .= '<WeightMajor>5</WeightMajor>';
		$requestXmlBody .= '<WeightMinor>2</WeightMinor>';
		
		
		
		$requestXmlBody .= '<DispatchTimeMax>3</DispatchTimeMax>';
		$itemDescription2 = utf8_encode($itemDescription);
		$requestXmlBody .= "<Quantity>1</Quantity>";
		$requestXmlBody .= "<StartPrice>$price</StartPrice>";
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
$condition_1 = array
  (
  array('unid' => '1', 'f1' => 'New'),
  array('unid' => '2', 'f1' => 'Seller Refurbished')
  array('unid' => '3', 'f1' => 'Seller Refurbished Modified')
  array('unid' => '4', 'f1' => 'Manufactured Refurbished')
  array('unid' => '5', 'f1' => 'Manufactured Refurbished Modified')
  array('unid' => '6', 'f1' => 'Used')
  array('unid' => '7', 'f1' => 'Used Modified')
  array('unid' => '8', 'f1' => 'Parts or Repair')  
  );

$condition_2 = array
  (
  array('unid' => '1', 'f1' => 'Excellent'),
  array('unid' => '2', 'f1' => 'Good')
  array('unid' => '3', 'f1' => 'Fair')
  array('unid' => '4', 'f1' => 'Poor')
  array('unid' => '5', 'f1' => 'Very Poor')
  );
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
		<form id="form_sku" action="ebay_other_list.php" method="post">
<table width="100%" border="0">

    <tr style="height: 35px;">
    <td>Product Id:</td>
    <td><?php echo generateTextAuto('unid', '', 'true');  ?><td>
	</tr>
	<td>Title:</td>
	<td><?php echo generateText('title', '', 'false');  ?><td>
	</tr>
		<tr style="height: 35px;">
    <td>Condition 1:</td>
	<td><?php echo generateSelect('cond_1', $condition_1);  ?><td>
	</tr>
			<tr style="height: 35px;">
    <td>Condition 2:</td>
	<td><?php echo generateSelect('cond_2', $condition_2, 'false');  ?><td>
	</tr>
	<tr style="height: 35px;">
    <td>Condition Desc:</td>
	<td><?php echo generateText('condition_desc', '', 'false');  ?><td>
	</tr>
	<tr style="height: 35px;">
    <td>Price:</td>
	<td><?php echo generateText('price', '', 'false');  ?><td>
	</tr>
	<tr style="height: 35px;">
    <td>Shipping:</td>
	<td><?php echo generateText('ship', '', 'false');  ?><td>
	</tr>
	<tr style="height: 35px;">
    <td>Description:</td>
	<td><?php echo generateTextArea('desc');  ?><td>
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