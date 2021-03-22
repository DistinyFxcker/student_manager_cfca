<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$certUserId = "35FE921E7CF0F890E050007F01004E8E";
$signatureOfUserId = strval ( p7SignMessageDetachByPFX ( $certUserId, $userKeystorePath, $userKeystorePassword ) );

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"certBinding" => array (
				"userId" => $certUserId,
				"signatureOfUserId" => $signatureOfUserId 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3301";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
