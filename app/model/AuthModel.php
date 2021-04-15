<?php


namespace app\model;


use think\facade\Db;
use think\Model;

class AuthModel extends Model
{
    public static function u_login_auth($u_name)
    {
       return  Db::table('u_info')->where('u_name',$u_name)->find();
    }
}