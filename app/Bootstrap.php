<?php

/**
 * @Author: whero
 * @Date  : 2018-05-26 17:39:56
 * @Desc  :
 */

class Bootstrap extends \Yaf\Bootstrap_Abstract
{
    /**
     * 视图
     */
    public function _initView(\Yaf\Dispatcher $dispatcher)
    {
        $dispatcher->disableView();
        $dispatcher->initView(BASE_PATH . "/templates");
    }

    /**
     * 路由
     */
    public function _initRoute(\Yaf\Dispatcher $dispatcher)
    {
//        $router = $dispatcher->getRouter();
//
//
//        $router->addRoute("admin", new \Yaf\Route\Rewrite(
//                "/admin",
//                array(
//                    "module"     => "Admin",
//                    "controller" => "Index",
//                    "action"     => "index",
//                    "method"     => "CLI",
//                )
//            )
//        );
//
//        $router->addRoute("authlogin", new \Yaf\Route\Rewrite(
//                "/auth/login",
//                array(
//                    "module"     => "Admin",
//                    "controller" => "Auth",
//                    "action"     => "login",
//                    "method"     => "CLI",
//                )
//            )
//        );
    }

}
