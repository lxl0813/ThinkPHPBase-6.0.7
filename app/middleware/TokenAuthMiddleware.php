<?php
declare (strict_types = 1);

namespace app\middleware;

use app\controller\Api\ResponseApi;

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

            $request->user_id=$jwt['data']->user_id;
            return $next($request);
        }catch(\Firebase\JWT\SignatureInvalidException $e) {  //签名不正确
            return response(["status"=>50000,"message"=>"token不正确"],200);
        }catch(\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
            return response(["status"=>50000,"message"=>"token不正确"],200);
        }catch(\Firebase\JWT\ExpiredException $e) {  // token过期
            return response(["status"=>50001,"message"=>"token过期"],200);
        }catch(\Exception $e) {  //其他错误
            return response(["status"=>50000,"message"=>"其他错误"],200);
        }
    }
}
