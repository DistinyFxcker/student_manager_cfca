<?php
error_reporting(-1);
ini_set('display_errors', 1);
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"generateShortUrl" => array (
				"userId" => "B2CF71F04ED5B85BE053AB2EA8C05E41",
				"contractNos" => array (
                    "QT20201113000004003"
                ),
				"signLocations" => array (
                    "Signature1"
                ),
				"signMode" => "0"
		)
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );
echo "sign: " . $sign . "<br><br>";

$txCode = "3911";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

// echo "req: " . $req . "<br><br>";
// echo "uri: " . $uri . "<br><br>";

echo curl ( "", $uri, $req );
?>