<?php
error_reporting(-1);
ini_set('display_errors', 1);
include "TestCurl.php";
include "TestSignature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"sendShortUrl" => array (
				"contractNo" => "QT20201113000004004",
				"signMode" => "0"
		)
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );
echo "sign: " . $sign . "<br><br>";

$txCode = "3912";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

// echo "req: " . $req . "<br><br>";
// echo "uri: " . $uri . "<br><br>";

echo curl ( "", $uri, $req );
?>