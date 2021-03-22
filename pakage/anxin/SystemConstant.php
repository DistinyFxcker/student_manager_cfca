<?php
// 生产系统
$userId = "32015409EEB52975E0538E02030A2087";
// 本地
// $userId = "9C9E731AEE444B498F7B5DCFBA0CD0E8";

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
$cacert = $configDir . DIRECTORY_SEPARATOR . "cql" . DIRECTORY_SEPARATOR . "cacert.pem";
$sslcertPwd = "cfcaCQL";

$keystorePath = $configDir . DIRECTORY_SEPARATOR . "cql" . DIRECTORY_SEPARATOR . "anxinsign.jks";
$keystorePassword = "cfcaCQL";
$keystoreAlias = "anxinsign";

$userKeystorePath = $configDir . DIRECTORY_SEPARATOR . "test.pfx";
$userKeystorePassword = "11111111";

// $sslcert = $configDir . DIRECTORY_SEPARATOR . "sslcert.pem";
// $cacert = $configDir . DIRECTORY_SEPARATOR . "cacert.pem";
// $sslcertPwd = "cfca1234";

// $keystorePath = $configDir . DIRECTORY_SEPARATOR . "anxinsign.jks";
// $keystorePassword = "cfca1234";
// $keystoreAlias = "筷子金融";

// $sslcert = $configDir . DIRECTORY_SEPARATOR .
// "/zhishangjinrong/zhishangjinrong.pem";
// $cacert = $configDir . DIRECTORY_SEPARATOR .
// "/zhishangjinrong/cert_test.pem";
// $sslcertPwd = "cfca1234";

// $keystorePath = $configDir . DIRECTORY_SEPARATOR .
// "/zhishangjinrong/test_zhishangjinrong.jks";
// $keystorePassword = "cfca1234";
// $keystoreAlias = "zhishangjinrong";
?>
