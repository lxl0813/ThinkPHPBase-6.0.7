<?php
declare (strict_types = 1);

namespace app\api\v1\controller;

use app\api\v1\model\AuthModel;
use app\api\v1\service\JwtService;
use app\api\v1\validate\UserValidate;
use app\BaseController;
use think\exception\ValidateException;
use think\Request;
use hg\apidoc\annotation as Apidoc;

/**
 * @Apidoc\Title("注册/登录")
 * @Apidoc\Group("Auth")
 */
class AuthController  extends BaseController
{
    /**
     * @param Request $request
     * @return \think\Response
     *
     */
    public function userLogin(Request $request)
    {
        $u_info =   $request->post();
        try {
            validate(UserValidate::class)->scene('user_login')->batch(true)->check($u_info);
        } catch (ValidateException $e) {
            return $this->ResponseCreate($e->getMessage(),[],"field_validate");
        }
        $u_base =   AuthModel::u_login_auth($u_info['u_name']);
        if($u_base==false){
            return $this->ResponseCreate('用户不存在',[],'user_account_not_found');
        }
        if(!password_verify($u_info['u_pwd'],$u_base['u_pwd'])){
            return $this->ResponseCreate('密码错误',[],'user_pwd_error');
        }
        if($u_base['u_status']==2){
            return $this->ResponseCreate('用户账号已经冻结！',[],'user_account_error');
        }
        $u_Token  =   JwtService::createToken(['u_id'=>$u_base['id'],'u_name'=>$u_base['u_name']]);
        $result   = [
            'u_id'  =>  $u_base['id'],
            'u_name'=>  $u_base['u_name'],
            'token' =>  $u_Token,
        ];
        return $this->ResponseCreate('登录成功！',$result);
    }




}
