<?php


namespace app;
use think\facade\Config;
use think\Response;


/**
 * Trait ResponseApi
 * @package app
 */
trait ResponseApi
{

    /**
     * @param string $message
     * @param array $data
     * @param int $code
     * @param int $httpCode
     * @param string $type
     * @return Response
     */
    protected function ResponseCreate(string $message = "" , $data = [] , $code = 1000 , int $httpCode = 200 , string $type = 'json'):Response
    {
        $resultResponse =   [
                                //业务状态码
                                'code'      =>  is_int($code)?$code:Config::get("code.".$code),
                                //消息
                                'message'   =>  $message,
                                //数据集
                                'data'      =>  $data,
                            ];
        //Api返回
        return Response::create($resultResponse,$type,$httpCode);
    }
}