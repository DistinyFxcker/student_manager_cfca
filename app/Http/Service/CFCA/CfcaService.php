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

    public function signature($src, $keystorePath, $keystorePassword, $keystoreAlias) {
        $client = new \Java ( "SignTest" );
        return $client->p7SignMessageDetach ( $src, $keystorePath, $keystorePassword, $keystoreAlias );
    }

    public function p7SignMessageDetachByPFX($src, $keystorePath, $keystorePassword) {
        $client = new \Java ( "SignTest" );
        return $client->p7SignMessageDetach ( $src, $keystorePath, $keystorePassword );
    }

    public function p7SignByHash($src, $keystorePath, $keystorePassword) {
        $client = new \Java ( "SignTest" );
        return $client->p7SignByHash ( $src, $keystorePath, $keystorePassword );
    }

    public function base64Decode($src) {
        $client = new \Java ( "SignTest" );
        return $client->base64Decode ( $src );
    }

    public function getSignCert($pfxPath, $pfxPassword) {
        $client = new \Java ( "SignTest" );
        return $client->getSignCert ( $pfxPath, $pfxPassword );
    }

    public function p1SignMessage($src, $pfxPath, $pfxPassword) {
        $client = new \Java ( "SignTest" );
        return $client->getSignCert ( $pfxPath, $pfxPassword );
    }

    public function curl($boundary, $uri, $req) {
        $curl = curl_init ();
// 	curl_setopt ( $curl, CURLOPT_URL, "https://192.168.113.125:8443/FEP/" . $uri );
// 	curl_setopt ( $curl, CURLOPT_URL, "https://210.74.42.33:9443/FEP/" . $uri );
        curl_setopt ( $curl, CURLOPT_URL, "https://cs.anxinsign.com/FEP/" . $uri );
        CURL_SETOPT ( $curl, CURLOPT_PORT, 443 );
        curl_setopt ( $curl, CURLOPT_ENCODING, "" );
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE ); // 设置是否返回信息
        curl_setopt ( $curl, CURLOPT_POST, TRUE ); // 设置为POST方式

        curl_setopt ( $curl, CURLOPT_SSLVERSION, 5 );
        curl_setopt ( $curl, CURLOPT_VERBOSE, TRUE ); // 开发模式，会把通信时的信息显示出来
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, TRUE ); // 验证服务器证书
        curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE ); // 不检查证书中域名
        curl_setopt ( $curl, CURLOPT_SSLCERT, self::sslCert() );
        curl_setopt ( $curl, CURLOPT_SSLCERTPASSWD, config('cfca.sslcertPwd') );
        curl_setopt ( $curl, CURLOPT_SSLCERTTYPE, "PEM" );
        curl_setopt ( $curl, CURLOPT_SSLKEY, self::sslCert() );
        curl_setopt ( $curl, CURLOPT_SSLKEYPASSWD, config('cfca.sslcertPwd') );
        curl_setopt ( $curl, CURLOPT_SSLKEYTYPE, "PEM" );
        curl_setopt ( $curl, CURLOPT_CAINFO, self::Cacert() );
	dd(file_exists(self::sslCert()));
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

    public function curl_custom_postfields($uri, $data, $signature, $file) {
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
}

