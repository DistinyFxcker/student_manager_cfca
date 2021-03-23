<?php

function curl_custom_postfields($uri, $data, $signature, $file) {
	$req [] = implode ( "\r\n", array (
			"Content-Disposition: form-data; name=\"data\"",
			"",
			$data 
	) );
	
	$req [] = implode ( "\r\n", array (
			"Content-Disposition: form-data; name=\"signature\"",
			"",
			$signature 
	) );
	
	$handle = fopen ( $file, "r" ); // 使用打开模式为r
	$content = fread ( $handle, filesize ( $file ) ); // 读为二进制
	
	$req [] = implode ( "\r\n", array (
			"Content-Disposition: form-data; name=\"contractFile\"; filename=\"1\"",
			"Content-Type: application/octet-stream; charset=--",
			"",
			$content 
	) );
	
	do {
		$boundary = "--" . md5 ( mt_rand () . microtime () );
	} while ( preg_grep ( "/{$boundary}/", $req ) );
	
	array_walk ( $req, function (&$part) use($boundary) {
		$part = "--{$boundary}\r\n{$part}";
	} );
	
	$req [] = "--{$boundary}--";
	$req [] = "";
	
	echo $req;
	
	echo curl ( $boundary, $uri, implode ( "\r\n", $req ) );
}

function curl($boundary, $uri, $req) {
	include "SystemConstant.php";
	$curl = curl_init ();
 	curl_setopt ( $curl, CURLOPT_URL, "https://210.74.42.33:9443/FEP/" . $uri );
//	curl_setopt ( $curl, CURLOPT_URL, "https://cs.anxinsign.com/FEP/" . $uri );
 	CURL_SETOPT ( $curl, CURLOPT_PORT, 9443 );
	curl_setopt ( $curl, CURLOPT_ENCODING, "" );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE ); // 设置是否返回信息
	curl_setopt ( $curl, CURLOPT_POST, TRUE ); // 设置为POST方式
	
	curl_setopt ( $curl, CURLOPT_SSLVERSION, 5 );
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
	
	curl_setopt ( $curl, CURLOPT_POSTFIELDS, $req );
	
	if ($boundary != "") {
		curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
				"Content-Type: multipart/form-data; boundary=" . $boundary 
		) );
	} else {
		curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
				"Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
				"Content-length: " . strlen ( $req ) 
		) );
	}
	
	$response = "response:" . curl_exec ( $curl ); // 接收返回信息
	
	if (curl_errno ( $curl )) { // 出错则显示错误信息
		$response = curl_error ( $curl );
	}
	
	curl_close ( $curl );
	
	return $response;
}
?>
