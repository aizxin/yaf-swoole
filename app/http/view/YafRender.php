<?php
/**
 * FileName: YafRender.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-22 00:07
 */

namespace swf\view;


use Hyperf\View\Mode;
use Hyperf\View\Render;

use Hyperf\Task\Task;
use Hyperf\Task\TaskExecutor;

class YafRender extends Render
{
    public function render(string $template, $data = [])
    {
        switch ($this->mode) {
            case Mode::SYNC:
                /** @var EngineInterface $engine */
                $engine = $this->container->get($this->engine);
                $result = $engine->render($template, $data, $this->config);
                break;
            case Mode::TASK:
            default:
                $executor = $this->container->get(TaskExecutor::class);
                $result = $executor->execute(new Task([$this->engine, 'render'], [$template, $data, $this->config]));
        }
        return $result;
    }
}