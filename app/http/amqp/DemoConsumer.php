<?php
/**
 * FileName: DemoConsumer.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-21 22:44
 */

namespace swf\amqp;

use Hyperf\Amqp\Annotation\Consumer;
use Hyperf\Amqp\Message\ConsumerMessage;
use Hyperf\Amqp\Result;

/**
 * @Consumer(exchange="hyperf", routingKey="hyperf", queue="hyperf", nums=1)
 */

class DemoConsumer extends ConsumerMessage
{
    public function consume($data): string
    {
        var_dump('DemoConsumer');
        var_dump($data);
        return Result::ACK;
    }
}