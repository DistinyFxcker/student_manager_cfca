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
								"signOnPage" => 2,
								"signLocationLBX" => 311,
								"signLocationLBY" => 389,
								"signLocationRUX" => 411,
								"signLocationRUY" => 489 
						) 
				),
				"signInfos" => array (
/* 						array (
								"userId" => "5D742D9D64D34614E05312016B0AD814",
								"authorizationTime" => "20160214171200",
								"location" => "成都",
								"signLocations" => array (
										array (
												"signOnPage" => 1,
												"signLocationLBX" => 121,
												"signLocationLBY" => 443,
												"signLocationRUX" => 198,
												"signLocationRUY" => 463 
										),
										array (
												"signOnPage" => 1,
												"signLocationLBX" => 96,
												"signLocationLBY" => 210,
												"signLocationRUX" => 161,
												"signLocationRUY" => 438 
										) 
								),
								"projectCode" => "002",
								"isProxySign" => 0 
						), */
						array (
								"userId" => "5DDA59FC95384BBAE05311016B0AA615",
								"authorizationTime" => "20160214171200",
								"location" => "成都",
								"signLocations" => array (
										array (
												"signOnPage" => 2,
												"signLocationLBX" => 181,
												"signLocationLBY" => 133,
												"signLocationRUX" => 283,
												"signLocationRUY" => 150 
										) 
								),
								"projectCode" => "002",
								"isProxySign" => 0 
						) 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3203";

$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl_custom_postfields ( $uri, $data, $sign, "./file/1.pdf" );
?>
