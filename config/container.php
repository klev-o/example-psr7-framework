<?php

use Framework\Container\Container;
use Zend\ServiceManager\ServiceManager;

//$container = new Container();
//$container = new Container(require __DIR__ . '/dependencies.php');

$config = require __DIR__ . '/config.php';
$container = new ServiceManager($config['dependencies']);

$container->setService('config', $config);

return $container;