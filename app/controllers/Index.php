<?php
/**
 * @Author: whero
 * @Date  : 2018-05-26 17:42:17
 * @Desc  : 默认控制器
 */

use swf\model\UserModel;
use Hyperf\Utils\Coroutine;
use Hyperf\Task\Task;
use swf\task\TestTask;
use swf\job\ExampleJob;

class IndexController extends Controller
{

    /**
     * @Author: whero
     * @Date  : 2018-05-26 17:45:05
     * @Desc  : 默认动作
     */
    public function indexAction()
    {
        $params = UserModel::query()->get()->toArray();
        var_dump($params);
        var_dump($this->redis->keys('*'));
        var_dump($this->task->execute(new Task([TestTask::class, 'handle'], [Coroutine::id()])));

        $this->job->push(make(ExampleJob::class,$params));
        $this->job->push(make(ExampleJob::class,$params), 5);
        /* 自己输出响应 */
//        return $this->response->write($this->render("index"));
    }

}
