<?php

/**
 * 业务状态码
 */
return [
    "success"                   =>  1000,       //成功
    "error"                     =>  4000,       //异常
    "not_login"                 =>  1001,       //未登录
    "user_is_register"          =>  1002,       //用户已注册
    "action_not_found"          =>  4001,       //方法未找到
    "field_validate"            =>  1003,       //字段验证
    "user_pwd_error"            =>  1004,       //登录密码错误
    "user_account_not_found"    =>  1005,       //用户不存在
    "user_account_error"        =>  1006        //用户账号异常

];