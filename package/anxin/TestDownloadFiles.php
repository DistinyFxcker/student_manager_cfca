<?php
include "SystemConstant.php";

$contractNos = "QT20161223000000164@QT20161223000000165";

$curl = curl_init ();
curl_setopt ( $curl, CURLOPT_URL, "https://cs.anxinsign.com/FEP/platId/3391C68C0F387426E0538D02030A7071/contractNos/{$contractNos}/batchDownloading" );
curl_setopt ( $curl, CURLOPT_PORT, 443 );
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
                                 
 echo $response;

if (curl_errno ( $curl )) { // 出错则显示错误信息
	echo curl_error ( $curl );
}

$destination_folder = "./file/";
$newfname = $destination_folder . "contracts.zip";
$newf = fopen ( $newfname, "wb" );
fwrite ( $newf, $response );
fclose ( $newf );

curl_close ( $curl ); // 关闭curl链接
?>
