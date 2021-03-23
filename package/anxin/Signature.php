<?php
include "SystemConstant.php";

define ( "JAVA_HOSTS", "localhost:8083" );
require_once ($javaDir . DIRECTORY_SEPARATOR . "Java.inc");

java_set_library_path ( "." . PATH_SEPARATOR . $libDir );

function signature($src, $keystorePath, $keystorePassword, $keystoreAlias) {
	$client = new Java ( "SignTest" );
	return $client->p7SignMessageDetach ( $src, $keystorePath, $keystorePassword, $keystoreAlias );
}

function p7SignMessageDetachByPFX($src, $keystorePath, $keystorePassword) {
	$client = new Java ( "SignTest" );
	return $client->p7SignMessageDetach ( $src, $keystorePath, $keystorePassword );
}

function p7SignByHash($src, $keystorePath, $keystorePassword) {
	$client = new Java ( "SignTest" );
	return $client->p7SignByHash ( $src, $keystorePath, $keystorePassword );
}

function base64Decode($src) {
	$client = new Java ( "SignTest" );
	return $client->base64Decode ( $src );
}

function getSignCert($pfxPath, $pfxPassword) {
	$client = new Java ( "SignTest" );
	return $client->getSignCert ( $pfxPath, $pfxPassword );
}

function p1SignMessage($src, $pfxPath, $pfxPassword) {
	$client = new Java ( "SignTest" );
	return $client->getSignCert ( $pfxPath, $pfxPassword );
}
?>
