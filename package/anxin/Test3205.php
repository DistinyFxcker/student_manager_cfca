<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$signatureAttr = "8Q6KlawvzTuMYJufXuSYdH9YgS0=";

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"signContract" => array (
				"contractNo" => "ZL20160712000000114",
				"signatureOfAttr" => strval ( p1SignMessage ( base64Decode ( $signatureAttr ), $userKeystorePath, $userKeystorePassword ) ) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3205";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
