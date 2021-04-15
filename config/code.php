<?php

/**
 * 业务状态码
 */
return [
    "success"                   =>  1000,       //成功
    "not_login"                 =>  1001,       //未登录
    "user_is_register"          =>  1002,       //用户已注册
    "field_validate"            =>  1003,       //字段验证
    "user_pwd_error"            =>  1004,       //登录密码错误
    "user_account_not_found"    =>  1005,       //用户不存在
    "user_account_error"        =>  1006,       //用户账号异常


    "error"                     =>  4000,       //异常
    "action_not_found"          =>  4001,       //方法未找到
    "token_not_found"           =>  4002,       //token不存在
    "bad_token"                 =>  4003,       //token不正确
    "token_delay"               =>  4004,       //token暂时没生效
    "token_overdue"             =>  4005,       //token过期
    "token_other_error"         =>  4006,       //token其他错误
];