<?php


namespace app\service;


use Firebase\JWT\JWT;

class JwtService
{
    public static function createToken($data,$exp = 60)
    {
        //当前时间
        $nowTime = time();
        //token体
        $token = [
            'iss' => 'http://www.data.com', //签发者
            'aud' => 'http://www.data.com', //jwt所面向的用户
            'iat' => $nowTime,              //签发时间
            'nbf' => $nowTime,              //在什么时间之后该jwt才可用
            'exp' => $nowTime + $exp,       //过期时间-10min
            'data' => $data                 //用户信息
        ];
        $jwt = JWT::encode($token, env("JWT_SECRET"));  //Token 加密生成。
        return $jwt;
    }
}