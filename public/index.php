<?php

// 报错误信息 线上要注释
ini_set('display_errors', 'On');
error_reporting(E_ALL);
/**
 * @name 框架入口
 * @author Sow
 */
define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/vendor/autoload.php';


$application = new \Yaf\Application(BASE_PATH . "/config/application.ini");

$application->bootstrap();

if (php_sapi_name() == 'cli') {
    $yafRequest = new \Yaf\Request\Simple("CLI");
    $yafRequest->setRequestUri($argv[1] ?? '/');
    $application->getDispatcher()->dispatch($yafRequest);
} else {
    $application->run();
}

?>