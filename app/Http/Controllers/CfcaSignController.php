<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Service\CFCA\CfcaService;
use Illuminate\Http\Request;
/**
 * CFCA数据下载
 * Class CfcaSignController
 * @package App\Http\Controllers\Admin
 */
class CfcaSignController extends Controller{

    /**
     * @Notes:开户测试
     * @param: ${param}
     * @return: ${return}
     * @author: cbk
     * @Time: 2021/3/12   16:38
     */
    public function openText(Request $request,CfcaService $service){
	$this->validate($request, [
   	 	'name' => 'required',
    		'identNo' => 'required',
		'mobilePhone'=>'required|integer',
		'address'=>'required',
	]);
        $str = array (
            "head" => array (
                "txTime" => date ( "YmdHis" )
            ),
            "person" => array (
                "personName" => $request->input('name'),
                "identTypeCode" => "0",
                "identNo" => $request->input('identNo'),
                "mobilePhone" => $request->input('mobilePhone'),
                "address" => $request->input('address'),
                "authenticationMode" => "公安部"
            ),
        );
	$data = json_encode($str);
        $sign = $service->signature($data,$service::KeysPath(),config('cfca.keystorePassword'),config('cfca.keystoreAlias'));
	$txCode = "3001";

	$req = "data=" . urlencode ( $data ) . "&signature=" . urlencode ( $sign );
	$uri = "platId/" . config('cfca.userId') . "/txCode/" . $txCode . "/transaction";
	$result = $service->curl( "", $uri, $req );
	return $result;
    }

    public function sendMessage(){
	
    }


}
