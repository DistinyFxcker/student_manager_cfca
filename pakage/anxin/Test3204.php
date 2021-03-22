<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"getContractSignatureAttr" => array (
				"contractNo" => "ZL20160726000000002",
				"signInfo" => array (
						"userId" => "35FE921E7CF0F890E050007F01004E8E",
						"location" => "成都",
						"signLocation" => "Signature2",
						"signCert" => strval ( getSignCert ( $userKeystorePath, $userKeystorePassword ) ) 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3204";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
