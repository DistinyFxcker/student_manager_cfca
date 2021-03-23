<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"createContract" => array (
				"templateId" => "7",
				"isSign" => "1",
				"signInfos" => array (
						array (
								"userId" => "35FE921E7CF0F890E050007F01004E8E",
								"authorizationTime" => "20150826171200",
								"location" => "北京",
								"signLocation" => "Signature1",
								"projectCode" => "003",
								"isProxySign" => "0",
								"isCopy" => "0" 
								//"IsCheckProjectCode"=>"1";
						),
						array (
								"userId" => "35FE921E7CF0F890E050007F01004E87",
								"authorizationTime" => "20150826171200",
								"location" => "北京",
								"signLocation" => "Signature1",
								"projectCode" => "003",
								"isProxySign" => "0",
								"isCopy" => "0"
								//"IsCheckProjectCode"=>"1";
						)
				),
				"investmentInfo" => array (
						"text1" => "居民身份证",
						"text2" => "居民身份证",
						"text3" => "居民身份证",
						"text4" => "居民身份证",
						"text5" => "居民身份证",
						"text6" => "居民身份证",
						"text7" => "居民身份证",
						"text8" => "居民身份证",
						"text9" => "居民身份证",
						"text10" => "居民身份证",
						"text11" => "居民身份证",
						"text12" => "居民身份证",
						"text13" => "居民身份证",
						"text14" => "居民身份证",
						"text15" => "居民身份证",
						"text16" => "居民身份证",
						"text17" => "居民身份证",
						"text18" => "居民身份证",
						"text19" => "居民身份证",
						"text20" => "居民身份证",
						"text21" => "居民身份证",
						"text22" => "居民身份证",
						"text23" => "居民身份证",
						"text24" => "居民身份证",
						"text25" => "居民身份证",
						"text26" => "居民身份证" 
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3201";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
