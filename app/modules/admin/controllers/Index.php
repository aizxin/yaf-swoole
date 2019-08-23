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
use swf\amqp\DemoProducer;

class IndexController extends Controller
{

    /**
     * @Author: whero
     * @Date  : 2018-05-26 17:45:05
     * @Desc  : 默认动作
     */
    public function indexAction()
    {
//        $params = UserModel::query()->get()->toArray();
//        var_dump($params);
//        var_dump($this->redis->keys('*'));
//        var_dump($this->task->execute(new Task([TestTask::class, 'handle'], [Coroutine::id()])));
//
//        $this->job->push(make(ExampleJob::class,$params));
//        $this->job->push(make(ExampleJob::class,$params), 5);
//
//        $this->amqp->produce(new DemoProducer(1));
//        $trg = $this->render('index');

//        $view = new \Yaf\View\Simple(BASE_PATH . "/templates", array(
////            'ext' => 'html' //doesn't allow use short tag in template
////        ));
///

        $trg = $this->view->render('index/index.html');

//        var_dump();
//        var_dump(\Yaf\Application::app()->getDispatcher()->getRouter());

//        print_r($this->getRequest());
        var_dump($trg);
        /* 自己输出响应 */
//        return $this->response->write($this->render("index"));
    }

}
