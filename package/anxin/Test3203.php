<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"uploadContract" => array (
				"isSign" => 1,
				"contractTypeCode" => "MM",
				"contractName" => "测试合同",
				"signLocations" => array (
						array (
								"signOnPage" => 4,
								"signLocationLBX" => 311,
								"signLocationLBY" => 389,
								"signLocationRUX" => 411,
								"signLocationRUY" => 489 
						) 
				),
				"signInfos" => array (
						array (
								"userId" => "3AC9457E88264288E050007F010021FF",
								"authorizationTime" => "20160214171200",
								"location" => "成都",
								"signLocations" => array (
										array (
												"signOnPage" => 4,
												"signLocationLBX" => 121,
												"signLocationLBY" => 443,
												"signLocationRUX" => 198,
												"signLocationRUY" => 463 
										),
										array (
												"signOnPage" => 6,
												"signLocationLBX" => 96,
												"signLocationLBY" => 420,
												"signLocationRUX" => 161,
												"signLocationRUY" => 438 
										) 
								),
								"projectCode" => "002",
								"isProxySign" => 1 
						),
						array (
								"userId" => "2ED6A713B9DED7EFE050007F01007886",
								"authorizationTime" => "20160214171200",
								"location" => "成都",
								"signLocations" => array (
										array (
												"signOnPage" => 5,
												"signLocationLBX" => 181,
												"signLocationLBY" => 133,
												"signLocationRUX" => 283,
												"signLocationRUY" => 150 
										) 
								),
								"projectCode" => "002",
								"isProxySign" => 1 
						) 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3203";

$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl_custom_postfields ( $uri, $data, $sign, "./file/2.pdf" );
?>
