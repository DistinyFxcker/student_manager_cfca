<?php
// Dir
include "SystemConstant.php";

$contractNo = "WT20181121000000085";

$curl = curl_init ();
curl_setopt ( $curl, CURLOPT_URL, "https://210.74.42.33:9443/FEP/platId/79A770D3F4746320E05311016B0AD488/contractNo/{$contractNo}/downloading" );
curl_setopt ( $curl, CURLOPT_PORT, 9443 );
curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE ); // 设置是否返回信息
curl_setopt ( $curl, CURLOPT_HEADER, FALSE );

curl_setopt ( $curl, CURLOPT_SSLVERSION, 6 );
curl_setopt ( $curl, CURLOPT_VERBOSE, TRUE ); // 开发模式，会把通信时的信息显示出来
curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, TRUE ); // 验证服务器证书
curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE ); // 不检查证书中域名

curl_setopt ( $curl, CURLOPT_SSLCERT, $sslcert );
curl_setopt ( $curl, CURLOPT_SSLCERTPASSWD, $sslcertPwd );
curl_setopt ( $curl, CURLOPT_SSLCERTTYPE, "PEM" );

curl_setopt ( $curl, CURLOPT_SSLKEY, $sslcert );
curl_setopt ( $curl, CURLOPT_SSLKEYPASSWD, $sslcertPwd );
curl_setopt ( $curl, CURLOPT_SSLKEYTYPE, "PEM" );

curl_setopt ( $curl, CURLOPT_CAINFO, $cacert );

$response = curl_exec ( $curl ); // 接收返回信息
                                 
// echo $response;

if (curl_errno ( $curl )) { // 出错则显示错误信息
	echo curl_error ( $curl );
}

$destination_folder = "D://test";
$newfname = $destination_folder . $contractNo . ".pdf";
$newf = fopen ( $newfname, "wb" );
fwrite ( $newf, $response );
fclose ( $newf );

curl_close ( $curl ); // 关闭curl链接
?>
