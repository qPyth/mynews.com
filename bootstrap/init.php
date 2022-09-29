<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

$builder = new ContainerBuilder();
$builder->addDefinitions(BASE_PATH.'/config/di.php');
$container = $builder->build();
AppFactory::setContainer($container);
$app = AppFactory::create();