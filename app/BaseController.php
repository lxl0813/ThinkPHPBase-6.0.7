<?php
declare (strict_types = 1);

namespace app;


use app\ResponseApi;
use think\App;
use think\exception\ValidateException;
use think\facade\Config;
use think\facade\Request;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    use ResponseApi;
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 页数
     * @var int
     */
    protected   $page;

    /**
     * 分页条数
     * @var int
     */
    protected   $pageSize;


    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;
        //获取分页
        $this->page     =   (int)Request::param('page',1);
        //获取每页条数
        $this->pageSize =   (int)Request::param('page_size',Config::get('app.page_size'));
        // 控制器初始化
        $this->initialize();
    }


    /**
     *初始化
     */
    protected function initialize()
    {

    }

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }
        return $v->failException(true)->check($data);
    }


    /**
     * 路由方法未找到。返回错误
     * @param $name
     * @param $arguments
     * @return \think\Response
     */
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        //404,方法不存在
        return $this->ResponseCreate("找不到{$name}",[],"action_not_found",404);
    }

}
