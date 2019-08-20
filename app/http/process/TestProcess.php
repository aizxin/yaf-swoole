<?php
/**
 * FileName: TestProcess.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-20 23:26
 */

namespace swf\process;


use Hyperf\Process\AbstractProcess;

class TestProcess extends AbstractProcess
{
    /**
     * @var string
     */
    public $name = 'test-process';

    /**
     * @var int
     */
    public $nums = 1;

    public function handle(): void
    {
        var_dump($this->name);
    }
}