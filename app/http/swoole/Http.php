<?php
/**
 * FileName: Http.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-06-27 13:06
 */

namespace swf\swoole;

/**
 * Class Http
 * @package swf
 * Author: kong | <iwhero@yeah.com>
 */

use Hyperf\Event\EventDispatcher;
use Hyperf\Framework\Bootstrap\FinishCallback;
use Hyperf\Framework\Bootstrap\TaskCallback;
use Hyperf\Framework\Event\BeforeMainServerStart;
use Hyperf\Utils\ApplicationContext;
use Swoole\Runtime;
use Swoole\WebSocket\Server as WebSocketServer;
use Swoole\Http\Server as HttpServer;
use Swoole\Server as SwooleServer;

use Yaf\Registry;
use Yaf\Request\Http as YafHttp;

class Http extends Server
{
    protected $lastMtime;
    protected $config = [];
    protected $yafApp;
    protected $container;

    /**
     * 架构函数
     * @access public
     */
    public function __construct($config = [])
    {
        $this->container = ApplicationContext::getContainer();
        $this->config = $config;
    }

    /**
     * @param array $config
     *
     * @return $this
     */
    public function setConfig($config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->option = array_merge($this->option, $this->config['swoole']);

        return $this;
    }

    /**
     * @return mixed
     * @author: kong | <iwhero@yeah.com>
     */
    public function getSwoole()
    {
        $this->run();
        Registry::set('swoole', $this->swoole);
        $this->serverListener();

        return $this->swoole;
    }

    private function run()
    {
        $host = $this->option['host'] ?? $this->host;
        $port = $this->option['port'] ?? $this->port;
        $mode = $this->option['mode'] ?? $this->mode;
        $sockType = $this->option['sockType'] ?? $this->sockType;
        switch ($this->option['server_type'] ?? '') {
            case 'websocket':
                $this->swoole = new WebSocketServer($host, $port, $mode, $sockType);
                break;
            default:
                $this->swoole = new HttpServer($host, $port, $mode, $sockType);
        }
        $this->setOption($this->option);

        // 开启 协程
        if ($this->option['enable_coroutine'] ?? false) {
            Runtime::enableCoroutine(true);
        }
    }

    private function setOption($option = [])
    {
        // 设置参数
        if ( ! empty($option)) {
            $this->swoole->set($option);
        }

        foreach ($this->event as $event) {
            // 自定义回调
            if ( ! empty($option[ $event ])) {
                $this->swoole->on($event, $option[ $event ]);
            } elseif (method_exists($this, 'on' . $event)) {
                $this->swoole->on($event, [$this, 'on' . $event]);
            }
        }
    }

    /**
     * @param $server
     */
    public function onStart($server)
    {
        @swoole_set_process_name("swf-server");
    }

    /**
     * 此事件在Worker进程/Task进程启动时发生,这里创建的对象可以在进程生命周期内使用
     *
     * @param $server
     * @param $worker_id
     */
    public function onWorkerStart($server, $worker_id)
    {
        $this->lastMtime = time();
        $this->initYafApp();
    }


    /**
     * peceive回调
     *
     * @param $server
     * @param $fd
     * @param $reactor_id
     * @param $data
     */
    public function onReceive($server, $fd, $reactor_id, $data)
    {

    }


    /**
     * request回调
     *
     * @param $request
     * @param $response
     */
    public function onRequest($request, $response)
    {
        //请求过滤,会请求2次
        if (in_array('/favicon.ico', [$request->server['path_info'], $request->server['request_uri']])) {
            return $response->end();
        }

        Registry::set('request', $request);
        Registry::set('response', $response);

        ob_start();
        $yafRequest = new YafHttp($request->server['request_uri'], '/');

        try {
            $this->yafApp->getDispatcher()->dispatch($yafRequest);
        } catch (\Yaf\Exception $e) {
            $this->errorException($e);
        } catch (\Exception $e) {
            $this->errorException($e);
        } catch (\Throwable $e) {
            $this->errorException($e);
        }
        $result = ob_get_contents();
        ob_end_clean();
        // add Header
        $response->header('Content-Type', 'application/json; charset=utf-8');
        // add cookies
        // set status
        $response->end($result);
    }

    /**
     * onOpen回调
     *
     * @param $server
     * @param $frame
     */
    public function onOpen($server, $request)
    {

    }

    /**
     * Message回调
     *
     * @param $server
     * @param $frame
     */
    public function onMessage($server, $frame)
    {

    }

    /**
     * Close回调
     *
     * @param $server
     * @param $frame
     */
    public function onClose($server, $fd)
    {

    }

    /**
     * 任务投递
     *
     * @param HttpServer $serv
     * @param            $task_id
     * @param            $fromWorkerId
     * @param            $data
     *
     * @return mixed|null
     */
    public function onTask(SwooleServer $serv, $taskId, $srcWorkerId, $data)
    {
        $this->container->get(TaskCallback::class)->onTask($serv,$taskId, $srcWorkerId, $data);
    }

    /**
     * 任务结束，如果有自定义任务结束回调方法则不会触发该方法
     *
     * @param HttpServer $serv
     * @param            $task_id
     * @param            $data
     */
    public function onFinish(SwooleServer $serv, $task_id, $data)
    {
        $this->container->get(FinishCallback::class)->onFinish($serv,$task_id, $data);
    }

    /**
     * @author: kong | <iwhero@yeah.com>
     * @date  : 2019-07-03 10:19
     */
    private function initYafApp()
    {
        $this->yafApp = new \Yaf\Application($this->config);
        $this->yafApp->bootstrap();

    }

    /**
     * 错误 处理
     *
     * @param $e
     *
     * @author: kong | <iwhero@yeah.com>
     * @date  : 2019-07-02 22:17
     */
    private function errorException($e)
    {
        $request = new YafHttp('error/error', '/');
        $request->setParam('error', $e);
        $this->yafApp->getDispatcher()->dispatch($request);
    }

    /**
     * 监听
     * @author: kong | <iwhero@yeah.com>
     * @date  : 2019-08-20 23:33
     */
    protected function serverListener()
    {
        $this->container->get(EventDispatcher::class)->dispatch(new BeforeMainServerStart($this->swoole, []));

    }
}