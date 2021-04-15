<?php


namespace app\api\v1\validate;


use think\Validate;

/**
 * Class AuthLoginValidate
 * @package app\validate
 */
class UserValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'u_nickname'     =>  'require|alphaDash|length:6,16',
        'u_password'     =>  'require|alphaDash|length:6,16',
        'u_repassword'   =>  'require|confirm:u_password',
        'u_new_password' =>  'require|alphaDash|length:6,16',
        'u_name'         =>  'require|chsAlpha',
        'u_birthday'     =>  'date',
        'u_sex'          =>  'require|accepted',
        'v_code'         =>  'require|number',
        'u_mobile'       =>  'require|mobile',
        'u_email'        =>  'require|email',

    ];

    /**
     * 验证消息
     * @var string[]
     */
    protected $message  =   [
        'u_nickname.require'    =>   '用户昵称必须',
        'u_nickname.alphaDash'  =>   '用户昵称字母和数字，下划线_及破折号-！',
        'u_nickname.length'     =>   '用户昵称6-16位',
        'u_password.require'    =>   '密码必须',
        'u_password.alphaDash'  =>   '用户密码字母和数字，下划线_及破折号-！',
        'u_password.length'     =>   '用户密码6-16位',
        'u_repassword.require'  =>   '确认密码必须',
        'u_repassword.confirm'  =>   '密码不一致',
        'u_name.require'        =>   '用户姓名必须',
        'u_name.alphaDash'      =>   '用户姓名汉字或英文',
        'u_birthday.data'       =>   '生日格式错误：年月日',
        'u_sex.require'         =>   '用户性别必须',
        'u_sex.accepted'        =>   '用户性别格式错误',
        'v_code.require'        =>   '验证码必须',
        'u_mobile.require'      =>   '手机号码必须',
        'u_mobile.mobile'       =>   '手机号码格式错误',
        'u_email.require'       =>   '邮箱必须',
        'u_email.email'         =>   '邮箱格式错误'
    ];


    /**
     * 验证场景
     * @var \string[][]
     */
    protected $scene = [
        'user_login'            =>  ['u_nickname','u_password','v_code'],
        'user_register'         =>  ['u_nickname','u_password','u_repassword','u_name','u_birthday','u_sex','v_code','u_mobile','u_email'],
        'user_base_edit'        =>  ['u_nickname','u_birthday','u_sex','u_mobile','u_email'],
        'user_password_edit'    =>  ['v_code','u_new_password']
    ];
}