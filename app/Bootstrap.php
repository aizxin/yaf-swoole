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
    }
}
