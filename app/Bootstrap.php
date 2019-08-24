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
        $dispatcher->registerPlugin(new RouterPlugin($dispatcher));
    }

}
