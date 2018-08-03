<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
require_once("../resources/config.php"); 

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
//	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction is successfull</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount

			$sql = "INSERT INTO orders ";
    $sql .= "(ORDERID, TXNAMOUNT, CURRENCY, STATUS, TXN_DATE) ";
    $sql .= "VALUES (";
    $sql .= "'" . escape_string($_POST['ORDERID']) . "',";
    $sql .= "'" . escape_string($_POST['TXNAMOUNT']) . "',";
    $sql .= "'" . escape_string($_POST['CURRENCY']) . "',";
    $sql .= "'" . escape_string($_POST['STATUS']) . "',";

    $sql .= "'" . escape_string($_POST['TXNDATE']) . "'";
    $sql .= ")";
  ;
    $query=query($sql);
confirm($query);

$query2=query("SELECT * from orders where ORDERID='". escape_string($_POST['ORDERID']) ."' LIMIT 1 ");
confirm($query2);

$row=fetch_array($query2);
echo "<p> Your transaction id is " . $row['ORDERID'] . "</p>";
echo "<p> Your transaction status is " . $row['STATUS'] . "</p>";
echo "<p> Your transaction amount is " . $row['TXNAMOUNT'] . "</p>";
echo "<p> Your transaction date is " . $row['TXN_DATE'] . "</p>";


	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	/*if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	*/

}
else {
	echo "<b>TRANSACTION FAILED.</b>";
	//Process transaction as suspicious.
}

?>