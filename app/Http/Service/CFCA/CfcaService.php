<?php
namespace App\Http\Service\CFCA;
define ( "JAVA_HOSTS", "localhost:8083" );
require_once(base_path('package'.DIRECTORY_SEPARATOR.'anxin'.DIRECTORY_SEPARATOR.'java'.DIRECTORY_SEPARATOR.'Java.inc'));
java_set_library_path ( CfcaService::getAnxinLibPath() );

class CfcaService{

    public static function getAnxinJavaPath(){
      return $anxinPaht = base_path('package'.DIRECTORY_SEPARATOR.'anxin'.DIRECTORY_SEPARATOR.'java');
    }

    public static function getAnxinLibPath(){
        return base_path('package'.DIRECTORY_SEPARATOR.'anxin'.DIRECTORY_SEPARATOR.'lib');
    }

    public static function getAnxinConfig(){
        return base_path('package'.DIRECTORY_SEPARATOR.'anxin'.DIRECTORY_SEPARATOR.'config');
    }

    /**
     * @Notes:ssl证书地址
     * @param: ${param}
     * @return: ${return}
     * @author: cbk
     * @Time: 2021/3/15   9:01
     */
    public static function sslCert(){
        return self::getAnxinConfig().DIRECTORY_SEPARATOR."cql" . DIRECTORY_SEPARATOR . "sslcert.pem";
    }

    /**
     * @Notes:sslcacert地址
     * @param: ${param}
     * @return: ${return}
     * @author: cbk
     * @Time: 2021/3/15   9:01
     */
    public static function Cacert(){
        return self::getAnxinConfig().DIRECTORY_SEPARATOR."cql" . DIRECTORY_SEPARATOR . "cacert.pem";
    }

    /**
     * @Notes:监听地址
     * @param: ${param}
     * @return: ${return}
     * @author: cbk
     * @Time: 2021/3/15   9:02
     */
    public static function KeysPath(){
        return self::getAnxinConfig().DIRECTORY_SEPARATOR . "cql" . DIRECTORY_SEPARATOR . "anxinsign.jks";
    }

    //监听方法

    function signature($src, $keystorePath, $keystorePassword, $keystoreAlias) {
        $client = new \Java ( "SignTest" );
        return $client->p7SignMessageDetach ( $src, $keystorePath, $keystorePassword, $keystoreAlias );
    }

    function p7SignMessageDetachByPFX($src, $keystorePath, $keystorePassword) {
        $client = new \Java ( "SignTest" );
        return $client->p7SignMessageDetach ( $src, $keystorePath, $keystorePassword );
    }

    function p7SignByHash($src, $keystorePath, $keystorePassword) {
        $client = new \Java ( "SignTest" );
        return $client->p7SignByHash ( $src, $keystorePath, $keystorePassword );
    }

    function base64Decode($src) {
        $client = new \Java ( "SignTest" );
        return $client->base64Decode ( $src );
    }

    function getSignCert($pfxPath, $pfxPassword) {
        $client = new \Java ( "SignTest" );
        return $client->getSignCert ( $pfxPath, $pfxPassword );
    }

    function p1SignMessage($src, $pfxPath, $pfxPassword) {
        $client = new \Java ( "SignTest" );
        return $client->getSignCert ( $pfxPath, $pfxPassword );
    }
}

