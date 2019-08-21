<?php
/**
 * FileName: Controller.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-20 22:45
 */

use \Hyperf\Utils\ApplicationContext;
use \Hyperf\Redis\Redis;
use \Hyperf\Task\TaskExecutor;
use \Hyperf\AsyncQueue\Driver\DriverFactory;
use Hyperf\Amqp\Producer;

class Controller extends \Yaf\Controller_Abstract
{
    protected $container;
    protected $redis;
    protected $task;
    protected $job;
    protected $amqp;

    public function init()
    {
        $this->container = ApplicationContext::getContainer();
        $this->redis = $this->container->get(Redis::class);
        $this->task = $this->container->get(TaskExecutor::class);
        $this->job = $this->container->get(DriverFactory::class)->get('default');
        $this->amqp = $this->container->get(Producer::class);
    }
}