<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$imageFile = file_get_contents ( "./image/seal2.png" );
$imageData = base64_encode ( $imageFile );

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"sealUpdate" => array (
				"userId" => "28EDF6F7F84B409DB9D20AB4434A0016",
				"seal" => array (
						"sealId" => "8AABC43851BE4753949EE5684648E0E6",
						"imageData" => $imageData 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3012";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
