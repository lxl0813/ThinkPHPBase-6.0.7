<?php
declare (strict_types = 1);

namespace app\middleware;

use app\controller\Api\ResponseApi;
use Firebase\JWT\JWT;

/**
 * Class TokenAuthMiddleware
 * @package app\middleware
 */
class TokenAuthMiddleware
{
    use ResponseApi;
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //验证token是否存在和是否过期等
        $token=$request->header("token");
        if($token==""){
            return $this->ResponseCreate('Token不存在',[],"token_not_found");
        }
        try{
            $decoded=JWT::decode($token,env("JWT_SECRET"),["HS256"]);
            $jwt=(array)$decoded;
            $request->u_id      =   $jwt['data']->u_id;
            $request->u_name    =   $jwt['data']->u_name;
            return $next($request);
        }catch(\Firebase\JWT\SignatureInvalidException $e) {  //签名不正确
            return $this->ResponseCreate('Token不正确',[],"bad_token");
        }catch(\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
            return $this->ResponseCreate('Token暂未生效，请等待！',[],"token_delay");
        }catch(\Firebase\JWT\ExpiredException $e) {  // token过期
            return $this->ResponseCreate('Token过期！',[],"token_overdue");
        }catch(\Exception $e) {  //其他错误
            return $this->ResponseCreate('Token其他错误！',[],"token_other_error");
        }
    }
}
