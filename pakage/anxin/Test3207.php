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
		"signContractByKeyword" => array (
				"contractNo" => "MM20170310000000001",
				"signInfo" => array (
						"userId" => "9C7DDE91AD9C479587CE2C7EF0EA51DC",
						"authorizationTime" => "20160801095509",
						"location" => "211.94.108.226",
						"projectCode" => "003",
						"imageData" => $imageData 
				),
				"signKeyword" => array (
						"keyword" => "受让方",
						"offsetCoordX" => "0",
						"offsetCoordY" => "20",
						"imageWidth" => "150",
						"imageHeight" => "150" 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3207";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
