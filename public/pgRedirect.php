<?php header("Pragma: no-cache"); 
header("Cache-Control: no-cache"); 
header("Expires: 0"); 
// following files need to be included 
require_once("./lib/config_paytm.php"); 
require_once("./lib/encdec_paytm.php");
 $checkSum = "";
 $paramList = array();
 $ORDER_ID = $_POST["ORDER_ID"];
 $CUST_ID = $_POST["CUST_ID"];
 $INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
 $CHANNEL_ID = $_POST["CHANNEL_ID"]; $TXN_AMOUNT = $_POST["TXN_AMOUNT"]; 
  $item_rows=$_POST['item_rows'];
 //$FIRST_NAME = $_POST["FIRST_NAME"]; 
 //$LAST_NAME = $_POST["LAST_NAME"];
  // Create an array having all required parameters for creating checksum.
   $paramList["MID"] = PAYTM_MERCHANT_MID;
    $paramList["ORDER_ID"] = $ORDER_ID;
     $paramList["CUST_ID"] = $CUST_ID;
      $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID; 
      $paramList["CHANNEL_ID"] = $CHANNEL_ID;
    $paramList["TXN_AMOUNT"] = $TXN_AMOUNT; 
    $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
    /* paytm data to send item details 
    $paramList[$item_rows]=$item_rows; 
for($x=1;$x<=$item_rows;i++){

  $item_name_no='item_name_' . $x;
  $paramList[$item_name_no]=$_POST[$item_name_no];
  
  $item_number_no='item_number_' . $x;
  $paramList[$item_number_no]=$_POST[$item_number_no];

  $item_amount_no='amount_' . $x;
  $paramList[$item_amount_no]=$_POST[$item_amount_no];
  
  $item_quantity_no='quantity_' . $x;
  $paramList[$item_quantity_no]=$_POST[$item_quantity_no];

}
*/
    //$paramList["EMAIL"] = $EMAIL;
     //Email ID of customer 
   $paramList["CALLBACK_URL"] = "http://localhost/ecom/public/thank_you.php"; //$paramList["MERC_UNQ_REF"] = $FIRST_NAME._.$LAST_NAME;
     // %!#$&*() are not allow //dynamically value pass
      /* $paramList["CALLBACK_URL"] = "http://localhost/PaytmKit/pgResponse.php";
       $paramList["MSISDN"] = $MSISDN; //Mobile number of customer 
       $paramList["EMAIL"] = $EMAIL; //Email ID of customer $paramList["VERIFIED_BY"] = "EMAIL"; // $paramList["IS_USER_VERIFIED"] = "YES"; // //$paramList["MERC_UNQ_REF"] = "merchant3"; */
        //Here checksum string will return by getChecksumFromArray() function. 
       $checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY); ?>

<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>