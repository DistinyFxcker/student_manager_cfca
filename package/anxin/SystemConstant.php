<?php
// 生产系统
//$userId = "A2BE257DB3952327E05312016B0A26E8";
$userId = "AF8E6507C48B297DE05311016B0A71A4";
// 本地
//$userId = "58909EA84E097579E05312016B0A7576"; //思邦ID

$here = realpath ( dirname ( $_SERVER ["SCRIPT_FILENAME"] ) );
$javaDir = $here . DIRECTORY_SEPARATOR . "java";
$libDir = $here . DIRECTORY_SEPARATOR . "lib";
$configDir = $here . DIRECTORY_SEPARATOR . "config";

// $sslcert = $configDir . DIRECTORY_SEPARATOR . "admin.pem";
// $cacert = $configDir . DIRECTORY_SEPARATOR . "cert.pem";
// $sslcertPwd = "Abcd1234";

// $keystorePath = $configDir . DIRECTORY_SEPARATOR . "admin.jks";
// $keystorePassword = "Abcd1234";
// $keystoreAlias = "041@z20100816001@devadmintest@00000002 (cfca test oca11)";

$sslcert = $configDir . DIRECTORY_SEPARATOR . "cql" . DIRECTORY_SEPARATOR . "sslcert.pem";
$sslcertPwd = "123456";
$cacert = $configDir . DIRECTORY_SEPARATOR . "cql" . DIRECTORY_SEPARATOR . "cacert.pem";


$keystorePath = $configDir . DIRECTORY_SEPARATOR . "cql" . DIRECTORY_SEPARATOR . "anxinsign.jks";
$keystorePassword = "123456";
$keystoreAlias = "anxinsign";

 $userKeystorePath = $configDir . DIRECTORY_SEPARATOR . "anxinsign.pfx";
 $userKeystorePassword = "123456"; 


?>
