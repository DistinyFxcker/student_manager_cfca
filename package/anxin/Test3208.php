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
		"signContractByCoordinate" => array (
				"contractNo" => "ZL20161031000000001",
				"signInfo" => array (
						"userId" => "3FBCDD43E51B4C72E050007F01001D1C",
						"authorizationTime" => "20160801095509",
						"location" => "211.94.108.226",
						"signLocation" => "Signature2",
						"projectCode" => "003",
						"imageData" => $imageData 
				),
				"signLocations" => array (
						array (
								"signOnPage" => "1",
								"signLocationLBX" => "85",
								"signLocationLBY" => "550",
								"signLocationRUX" => "140",
								"signLocationRUY" => "575" 
						) 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3208";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
