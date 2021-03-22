<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => date ( "YmdHis" ) 
		),
		"enterprise" => array (
				"enterpriseName" => "Test1",
				"identTypeCode" => "3",
				"identNo" => "123456",
				"email" => "33900139002@cfca.com.cn",
				"landlinePhone" => "58903552",
				"authenticationMode" => "公安部" 
		),
		"enterpriseTransactor" => array (
				"transactorName" => "王五",
				"identTypeCode" => "1",
				"identNo" => "362321199112050011",
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
