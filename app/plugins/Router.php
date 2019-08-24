<?php

/**
 * @name RouterPlugin
 * @desc   Yaf定义了如下的6个Hook,插件之间的执行顺序是先进先Call
 * @see    http://www.php.net/manual/en/class.yaf-plugin-abstract.php
 * @author afoii-12\administrator
 */
class RouterPlugin extends \Yaf\Plugin_Abstract
{

    private $dispatcher;

    public function __construct(\Yaf\Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }


    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
//        if (extension_loaded('Yaconf')) {
//            $router = \Yaconf::get('routes');
//        } else {
//            $router = (new \Yaf\Config\Ini(APP_PATH . "/conf/routes.ini"))->toArray();
//        }
//        $keys = array_keys($router);
//        $index = array_search($request->getRequestUri(), array_column($router, 'match'));
//
//        if ($index !== false) {
//
//            $array_names = $router[ $keys[ $index ] ]['route'] ?? ['error', 'error'];
//
//            $request->setRequestUri($request->getRequestUri());
//        }

    }

    public function routerShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {

    }

    public function dispatchLoopStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
    }

    public function preDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
    }

    public function postDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
    }

    public function dispatchLoopShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
    }
}
