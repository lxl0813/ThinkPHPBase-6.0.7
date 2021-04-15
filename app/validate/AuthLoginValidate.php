<?php


namespace app\validate;


use think\Validate;

/**
 * Class AuthLoginValidate
 * @package app\validate
 */
class AuthLoginValidate extends Validate
{
    /**
     * @var string[]
     */
    protected $rule = [
        'u_name'  =>  'require|alphaDash|length:6,16',
        'u_pwd'   =>  'require|alphaDash|length:6,16',
    ];

    /**
     * @var string[]
     */
    protected $message  =   [
        'u_name.require'    => '请填写用户名！',
        'u_name.alphaDash'  => '用户名字母和数字，下划线_及破折号-！',
        'u_name.length'     => '用户名6-16位',
        'u_pwd.require'     => '请填写密码！',
        'u_pwd.alphaDash'   => '密码字母和数字，下划线_及破折号-',
        'u_pwd.length'      => '密码6-16位',
    ];
}