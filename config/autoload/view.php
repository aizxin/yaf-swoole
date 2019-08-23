<?php
/**
 * FileName: view.php
 * ==============================================
 * Copy right 2016-2017
 * ----------------------------------------------
 * This is not a free software, without any authorization is not allowed to use and spread.
 * ==============================================
 * @author: kong | <iwhero@yeah.com>
 * @date  : 2019-08-22 00:04
 */
declare(strict_types=1);

use Hyperf\View\Mode;
use \swf\view\YafEngine;

return [
    // 使用的渲染引擎
    'engine' => YafEngine::class,
    // 不填写则默认为 Task 模式，推荐使用 Task 模式
    'mode' => Mode::TASK,
    'config' => [
        // 若下列文件夹不存在请自行创建
        'view_path' => BASE_PATH . "/templates",
        'cache_path' => BASE_PATH . '/runtime/view/',
    ],
];