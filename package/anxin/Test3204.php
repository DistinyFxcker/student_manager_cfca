<?php
include "TestCurl.php";
include "Signature.php";
include "SystemConstant.php";

$str = array (
		"head" => array (
				"txTime" => "20160102235959" 
		),
		"getContractSignatureAttr" => array (
				"contractNo" => "MM20171115000000108",
				"isSignP7" => "1",
				"signInfo" => array (
						"userId" => "5DDA59FC95384BBAE05311016B0AA615",
						"location" => "成都",
						"sealId" => "5DDA59FC953C4BBAE05311016B0AA615",
						"signCert" => "MIIEVDCCAzygAwIBAgIFEBWDgpAwDQYJKoZIhvcNAQEFBQAwWDELMAkGA1UEBhMCQ04xMDAuBgNVBAoTJ0NoaW5hIEZpbmFuY2lhbCBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTEXMBUGA1UEAxMOQ0ZDQSBURVNUIE9DQTEwHhcNMTcxMTE0MDcwMjE0WhcNMTkxMTE0MDcwMjE0WjCBhzELMAkGA1UEBhMCQ04xFzAVBgNVBAoTDkNGQ0EgVEVTVCBPQ0ExMREwDwYDVQQLEwhDRkNBdGVzdDEZMBcGA1UECxMQT3JnYW5pemF0aW9uYWwtMTExMC8GA1UEAwwoQ0ZDQUDmgJ3pgqbnmoTkvIHkuJrlrqLmiLdAWjY2NjY1NjY2NjZAMTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBALGJfzZjmdBC8ut3hWSFAZSEJ3EkGNmLq9CE+pslJf01a2G4D3aIfAH1RyPc+q3XUmpgCb++m6cwy1QMNV+LNk2U//dMZ76yFa0yUzxZXoauOLPY1FqIEsYIMbvn3KlL2C1sueESBu1UwD66K1dIPYJc9lDvybNwFKONp6FmXY24VuimNlwMkojfiS08XQzAEgZ7PjEI1HKxs+1AG53ge98mT1C4/X3yS1vIs0n44G+ufvZiu8NYCaP6kehD07dGBYZGogYnWCj2Cx2xyuQeRbyjOTygs8SBxf5Cpv2n0ZT8rGTZsCMn7Ee/MVOE5wNhQqHIkLaFFqY9TDtxp3W0DXcCAwEAAaOB9DCB8TAfBgNVHSMEGDAWgBTPcJ1h6518Lrj3ywJA9wmd/jN0gDBIBgNVHSAEQTA/MD0GCGCBHIbvKgEBMDEwLwYIKwYBBQUHAgEWI2h0dHA6Ly93d3cuY2ZjYS5jb20uY24vdXMvdXMtMTQuaHRtMDkGA1UdHwQyMDAwLqAsoCqGKGh0dHA6Ly91Y3JsLmNmY2EuY29tLmNuL1JTQS9jcmwzMTU3MS5jcmwwCwYDVR0PBAQDAgPoMB0GA1UdDgQWBBRFAIzBCf2DdAZ/RN5k1WcL++1aBDAdBgNVHSUEFjAUBggrBgEFBQcDAgYIKwYBBQUHAwQwDQYJKoZIhvcNAQEFBQADggEBACRyWo9hEOAdBkxXP7WPXIeTUhrAXu5PJ4svtY/WaQk4XokoH3sqejedoxuwAyk2D67MbxsFes8/Z25YgLGvtbNhAQ8IQvpMD7pJYoMZFxdq6xmr2Fn8n9VIhUepYRZ+Ar96etExUyfxSIUcphQmjU0467sIcL+//vUSLUdP/H+3bN6M2EozEEOsEWj3iPYiaeFRJfLxU0A+antWOf18gL2fmYBQwlg47j9S7OnGPk8MA26zRMebb2Xp2Ve3Z28QQ+nxIQkVAAaidkHRj8adEQEgoX3wG1JfD2ueLRoLGY/iWd5zyCkPJaXUYMYJLgw7+eo2i6mTDWJ35FqGu7vcjFw=",
// 						"sealId" => "5DDA59FC953C4BBAE05311016B0AA615"
				),
				"signLocation" => array (
						
								"signOnPage" => 1,
								"signLocationLBX" => 181,
								"signLocationLBY" => 133,
								"signLocationRUX" => 283,
								"signLocationRUY" => 150
										
				) 
		) 
);

$data = json_encode ( $str );
echo "data: " . $data . "<br><br>";

$sign = signature ( $data, $keystorePath, $keystorePassword, $keystoreAlias );

$txCode = "3204";

$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
$uri = "platId/" . $userId . "/txCode/" . $txCode . "/transaction";

echo curl ( "", $uri, $req );
?>
