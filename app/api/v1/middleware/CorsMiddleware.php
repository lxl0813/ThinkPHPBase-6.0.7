<?php
declare (strict_types = 1);

namespace app\api\v1\middleware;

class CorsMiddleware
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
        $origin = $request->header('Origin', '');

        //OPTIONS请求返回204请求
        if ($request->method(true) === 'OPTIONS') {
            $response->code(204);
        }
        $response->header([
            'Access-Control-Allow-Origin'      => $origin,
            'Access-Control-Allow-Methods'     => 'GET,POST,PUT',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Headers'     => '*',
        ]);
        return $response;
    }
}
