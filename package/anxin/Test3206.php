<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$imageFile = file_get_contents ( "./image/seal.png" );
$imageData = base64_encode ( $imageFile );

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"signContract" => array (
				"contractNo" => "ZL20160826000000123",
				"signInfo" => array (
						"userId" => "39126292503E6231E050007F01005DB1",
						"authorizationTime" => "20160801095509",
						"location" => "211.94.108.226",
						"signLocation" => "Signature2",
						"projectCode" => "003",
						"imageData" => $imageData 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3206";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
