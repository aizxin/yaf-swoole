<?php
/**
 * FileName: DemoProducer.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-21 22:42
 */

namespace swf\amqp;

use Hyperf\Amqp\Annotation\Producer;
use Hyperf\Amqp\Message\ProducerMessage;
use swf\model\UserModel;
/**
 * DemoProducer
 * @Producer(exchange="hyperf", routingKey="hyperf")
 */
class DemoProducer extends ProducerMessage
{
    public function __construct($id)
    {
        $user = UserModel::where('id', $id)->first();
        $this->payload = [
            'id' => $id,
            'data' => $user->toArray()
        ];
    }
}