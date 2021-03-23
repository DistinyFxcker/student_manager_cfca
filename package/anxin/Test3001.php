<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"person" => array (
				"personName" => "渣渣",
				"identTypeCode" => "0",
				"identNo" => "612325198009090000",
				"mobilePhone" => "13110018330",
				"address" => "成都",
				"authenticationMode" => "公安部" 
		),
		/*
		"isVerifyBankCard" => "0",
		"bankCardInfo" => array (
				"panNo" => "766",
				"mobilePhone" => "13110018330",
				"cardType" => "1",
				"validDate" => "1607",
				"cvn2" => "012" 
		) 
		*/
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );
echo "sign: " . $sign . "<br><br>";

$txCode = "3001";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>