<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"enterprise" => array (
				"enterpriseName" => "思邦的企业客户1",
				"identTypeCode" => "Z",
				"identNo" => "66666566666",
				"email" => "2143213333@test01.com.cn",
				"landlinePhone" => "028028028002",
				"authenticationMode" => "公安部" 
		),
		"enterpriseTransactor" => array (
				"transactorName" => "杨凡九",
				"identTypeCode" => "Z",
				"identNo" => "36232143143432",
				"address" => "北京" 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3002";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
