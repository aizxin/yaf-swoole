#!/usr/bin/env php
<?php

define('BASE_PATH', realpath(getcwd()));


require BASE_PATH . '/vendor/autoload.php';

use swf\swoole\Swf;
use Yaf\Config\Ini;

//错误信息将写入swoole日志中
date_default_timezone_set('Asia/Shanghai');

$config = (new Ini(BASE_PATH . "/config/application.ini", ini_get('yaf.environ')))->toArray();

use Hyperf\Config\ProviderConfig;
use Hyperf\Di\Annotation\Scanner;
use Hyperf\Di\Container;
use Hyperf\Di\Definition\DefinitionSource;
use Hyperf\Utils\ApplicationContext;

$configFromProviders = ProviderConfig::load();
$serverDependencies =  [];

$annotations = include BASE_PATH . '/config/autoload/annotations.php';

//$scanDirs = $annotations['scan']['paths'] ?? [];

$scanDirs = $configFromProviders['scan']['paths'];
$scanDirs = array_merge($scanDirs, $annotations['scan']['paths'] ?? []);


$container = new Container(new DefinitionSource($serverDependencies, $scanDirs, new Scanner(), true));

if ( ! $container instanceof \Psr\Container\ContainerInterface) {
    throw new RuntimeException('The dependency injection container is invalid.');
}

ApplicationContext::setContainer($container);

//var_dump($configFromProviders);


(new Swf($config))->run($argv);