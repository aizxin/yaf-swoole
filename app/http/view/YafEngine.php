<?php
/**
 * FileName: YafEngine.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-21 23:59
 */

namespace swf\view;


use Hyperf\View\Engine\EngineInterface;

class YafEngine implements EngineInterface
{
    public function render($template, $data, $config): string
    {
        $view = \Yaf\Application::app()->getDispatcher()->initView($config['view_path'],$config);
        return $view->render($template,$data);
    }
}