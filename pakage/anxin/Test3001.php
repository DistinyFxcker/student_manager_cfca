<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"person" => array (
				"personName" => "张三",
				"identTypeCode" => "0",
				"identNo" => "362321199112050002",
				"mobilePhone" => "15010111911",
				"address" => "北京",
				"authenticationMode" => "公安部" 
		),
		"isVerifyBankCard" => "0",
		"bankCardInfo" => array (
				"panNo" => "43674******36766",
				"mobilePhone" => "135*****111",
				"cardType" => "1",
				"validDate" => "1607",
				"cvn2" => "012" 
		) 
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