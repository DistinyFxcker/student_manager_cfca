<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Service\CFCA\CfcaService;

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
    public function openText(CfcaService $service){
        $str = array (
            "head" => array (
                "txTime" => date ( "YmdHis" )
            ),
            "person" => array (
                "personName" => "渣渣",
                "identTypeCode" => "0",
                "identNo" => "612325198009090000",
                "mobilePhone" => "13110018330",
                "address" => "成都",
                "authenticationMode" => "公安部"
            ),
        );
//        dd(json_encode($str),$service::KeysPath(),config('constance.keystorePassword'),config('constance.keystoreAlias'));
        $sign = $service->signature(json_encode($str),$service::KeysPath(),config('constance.keystorePassword'),config('constance.keystoreAlias'));
    }

}
