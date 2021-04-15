<?php


namespace app\api\v1\controller;


use app\BaseController;

/**
 * Class ErrorController
 * @package app\controller
 */
class ErrorController extends BaseController
{
    //404
    /**
     * @return \think\Response
     */
    public function index()
    {
        return $this->ResponseCreate('资源不存在',[],4000);
    }
}