<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

// $imageFile = file_get_contents ( "./image/seal.png" );
// $imageData = base64_encode ( $imageFile );

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"signContractByKeyword" => array (
				"contractNo" => "MM20171113000000006",
				"signInfo" => array (
						"userId" => "5DCD65D390382908E05311016B0A0055",
// 						"userId" => "5D742D9D695E4614E05312016B0AD814",
						"authorizationTime" => "20160801095509",
						"location" => "211.94.108.226",
						"projectCode" => "002",
						//"imageData" => $imageData 选择图片签章
						"sealId" => "5DCD65D3903B2908E05311016B0A0055"
				),
				"signKeyword" => array (
						"keyword" => "合同",
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
