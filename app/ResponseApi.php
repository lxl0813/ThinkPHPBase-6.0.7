<?php


namespace app;
use think\facade\Config;
use think\Response;

trait ResponseApi
{
    protected function ResponseCreate(string $message = "" ,$data = [] , $code = 1000 ,int $httpCode = 200 , string $type = 'json'):Response
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