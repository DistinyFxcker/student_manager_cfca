<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"sealQuery" => array (
				"userId" => "28EDF6F7F84B409DB9D20AB4434A0016",
				"sealId" => "09704802697D48059BB6D79A73DE928F" 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3014";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
